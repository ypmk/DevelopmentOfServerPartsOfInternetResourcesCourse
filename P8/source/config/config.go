package config

import (
	"encoding/json"
	"io"
	"os"

	"github.com/sirupsen/logrus"
)

type Config struct {
	Host       string `json:"host"`
	Port       string `json:"port"`
	CookieName string `json:"cookie_name"`
}

func LoadConfiguration(filename string) (Config, error) {
	var config Config
	configFile, err := os.Open(filename)

	if err == nil {
		jsonParser := json.NewDecoder(configFile)
		err = jsonParser.Decode(&config)
	}
	defer configFile.Close()
	return config, err
}

func LogInit(ofile *os.File, logFileName string) {
	ofile, err := os.OpenFile(logFileName, os.O_WRONLY|os.O_CREATE|os.O_APPEND, 0644)
	if err != nil {
		ofile = nil
		logrus.Error("Failed to create logfile" + logFileName)
		panic(err)
	}
	logrus.SetOutput(io.MultiWriter(ofile, os.Stdout))
}
