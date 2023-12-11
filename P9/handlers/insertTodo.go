package handlers

import (
	"encoding/json"
	"go-todos/database"
	"go-todos/models"
	"io/ioutil"
	"net/http"

	"gopkg.in/mgo.v2"
)

func InsertTodo(db database.TodoInterface) http.HandlerFunc {
	return func(w http.ResponseWriter, r *http.Request) {
		todo := models.Todo{}

		body, err := ioutil.ReadAll(r.Body)
		if err != nil {
			WriteResponse(w, http.StatusBadRequest, err.Error())
			return
		}

		err = json.Unmarshal(body, &todo)
		if err != nil {
			WriteResponse(w, http.StatusBadRequest, err.Error())
			return
		}

		res, err := db.Insert(todo)
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
		file, err := gridfs.Create("file.txt")
		if err != nil {
			panic(err)
		}

		defer file.Close()

		content := []byte("File!")
		file.Write(content)

		WriteResponse(w, http.StatusOK, res)
	}
}

func WriteResponse(w http.ResponseWriter, status int, res interface{}) {
	w.Header().Set("Content-Type", "application/json")
	w.WriteHeader(status)
	json.NewEncoder(w).Encode(res)
}
