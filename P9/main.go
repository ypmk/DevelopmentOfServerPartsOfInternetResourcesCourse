package main

import (
	"context"
	"go-todos/config"
	"go-todos/database"
	"go-todos/handlers"
	"net/http"

	"github.com/gorilla/mux"
)

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

	r.HandleFunc("/api/todos", handlers.SearchTodos(client)).Methods("GET")
	r.HandleFunc("/api/todos/{id}", handlers.GetTodo(client)).Methods("GET")
	r.HandleFunc("/api/todos", handlers.InsertTodo(client)).Methods("POST")
	r.HandleFunc("/api/todos/{id}", handlers.UpdateTodo(client)).Methods("PATCH")
	r.HandleFunc("/api/todos/{id}", handlers.DeleteTodo(client)).Methods("DELETE")

	http.ListenAndServe(":8080", r)
}
