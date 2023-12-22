package main

import (
	"context"
	"net/http"
	"os"

	"go01/server/config"
	"go01/server/database"
	"go01/server/handlers"

	"github.com/gorilla/mux"
	"github.com/sirupsen/logrus"

	"go01/source/config"
	"go01/source/handlers"
	"net/http"
)

var ofile *os.File

func main() {

	conf := config.GetConfig()
	ctx := context.TODO()

	db := database.ConnectDB(ctx, conf.Mongo)
	collection := db.Collection(conf.Mongo.Collection)

	client := &database.TodoClient{
		Col: collection,
		Ctx: ctx,
	}

	r := mux.NewRouter()

	r.HandleFunc("/todos", handlers.SearchTodos(client)).Methods("GET")
	r.HandleFunc("/todos/{id}", handlers.GetTodo(client)).Methods("GET")
	r.HandleFunc("/todos", handlers.InsertTodo(client)).Methods("POST")
	r.HandleFunc("/todos/{id}", handlers.UpdateTodo(client)).Methods("PATCH")
	r.HandleFunc("/todos/{id}", handlers.DeleteTodo(client)).Methods("DELETE")

	http.ListenAndServe(":8888", r)

	logFileName := "log.txt"

	config.LogInit(ofile, logFileName)
	defer ofile.Close()

	logrus.Info("program started!")
	cfg, _ := config.LoadConfiguration("config.json")
	logrus.Info("Port number detected: " + cfg.Port)
	handlers.SetCookieName(cfg.CookieName)

	http.HandleFunc("/api/savemessage", handlers.SaveMessageSync)
	http.HandleFunc("/api/savemessageasync", handlers.SaveMessageAsync)
	http.HandleFunc("/api/getmessage", handlers.GetMessage)
	logrus.Fatal(http.ListenAndServe(":"+cfg.Port, nil))
	logrus.Info("program exit")
}
