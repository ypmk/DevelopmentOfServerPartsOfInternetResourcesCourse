package handlers

import (
	"go-todos/database"
	"io"
	"net/http"

	"github.com/gorilla/mux"
	"gopkg.in/mgo.v2"
)

func GetTodo(db database.TodoInterface) http.HandlerFunc {
	return func(w http.ResponseWriter, r *http.Request) {
		params := mux.Vars(r)
		id := params["id"]

		res, err := db.Get(id)
		if err != nil {
			WriteResponse(w, http.StatusBadRequest, err.Error())
			return
		}

		session, err := mgo.Dial("mongodb://localhost:27017")
		if err != nil {
			panic(err)
		}
		defer session.Close()

		db := session.DB("mydb")
		gridfs := db.GridFS("fs")

		file, err := gridfs.Open("my_file.txt")
		if err != nil {
			panic(err)
		}

		defer file.Close()

		content, err := io.ReadAll(file)
		if err != nil {
			panic(content)
		}

		WriteResponse(w, http.StatusOK, res)
	}
}
