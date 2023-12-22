package handlers

import (
	b64 "encoding/base64"
	"encoding/json"
	secur "go01/server/utils"
	"net/http"
	"sync"
	"time"

	"github.com/sirupsen/logrus"
)

var cookie_name = "session_token"

func SetCookieName(name string) {
	cookie_name = name
}

// Create a struct that models the structure of a user in the request body
type Message struct {
	Message string `json:"message"`
}

func saveMessage(w http.ResponseWriter, r *http.Request) {
	var message Message
	// Get the JSON body and decode into credentials
	err := json.NewDecoder(r.Body).Decode(&message)
	if err != nil {
		// If the structure of the body is wrong, return an HTTP error
		logrus.Error("Failed to decode json body")
		w.WriteHeader(http.StatusBadRequest)
		return
	}

	ciphertext := secur.AesGcmEncrypt(message.Message)

	http.SetCookie(w, &http.Cookie{
		Name:    cookie_name,
		Value:   b64.StdEncoding.EncodeToString(ciphertext),
		Expires: time.Now().Add(120 * time.Second),
	})

	w.Write([]byte("Message saved"))
}

func saveMessageSubtask01(wg *sync.WaitGroup) {
	logrus.Info("Start doing saveMessageSubtask01")
	if wg != nil {
		defer wg.Done()
	}
	time.Sleep(5 * time.Second)
	logrus.Info("Completed doing saveMessageSubtask01")
}

func saveMessageSubtask02(wg *sync.WaitGroup) {
	logrus.Info("Start doing saveMessageSubtask02")
	if wg != nil {
		defer wg.Done()
	}
	time.Sleep(5 * time.Second)
	logrus.Info("Completed doing saveMessageSubtask02")
}

func SaveMessageAsync(w http.ResponseWriter, r *http.Request) {
	logrus.Info("SaveMessageAsync started")
	var wg sync.WaitGroup

	wg.Add(2)
	go saveMessageSubtask01(&wg)
	go saveMessageSubtask02(&wg)
	wg.Wait()
	saveMessage(w, r)
	logrus.Info("SaveMessageAsync completed")
}

func SaveMessageSync(w http.ResponseWriter, r *http.Request) {
	logrus.Info("SaveMessage started")

	saveMessageSubtask01(nil)
	saveMessageSubtask02(nil)

	saveMessage(w, r)
	logrus.Info("SaveMessage completed")
}

func GetMessage(w http.ResponseWriter, r *http.Request) {

	c, err := r.Cookie(cookie_name)
	if err != nil {
		if err == http.ErrNoCookie {
			logrus.Error("Cookie not found")
			w.WriteHeader(http.StatusNotFound)
			return
		}
		w.WriteHeader(http.StatusBadRequest)
		return
	}

	logrus.Info("Cookie found: " + c.Value)
	sDec, _ := b64.StdEncoding.DecodeString(c.Value)

	message := secur.AesGcmDecrypt([]byte(sDec))
	logrus.Info("Decrypted message: " + message)

	//w.Write([]byte(fmt.Sprintf("Cookie content", sessionToken)))
	w.Write([]byte("Decrypted message:" + message))
}
