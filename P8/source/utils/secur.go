//https://gist.github.com/tinti/1afe25d09ed918b4b3cf5bea8632e798

package secur

import (
	"crypto/aes"
	"crypto/cipher"
	"crypto/rand"
	"fmt"
	"io"
)

var key = make([]byte, 32)
var nonce = make([]byte, 12)

func init() {
	if _, err := io.ReadFull(rand.Reader, key); err != nil {
		panic(err.Error())
	}

	if _, err := io.ReadFull(rand.Reader, nonce); err != nil {
		panic(err.Error())
	}
}

// AesGcmEncrypt takes an encryption key and a plaintext string and encrypts it with AES256 in GCM mode, which provides authenticated encryption. Returns the ciphertext and the used nonce.
func AesGcmEncrypt(plaintext string) (ciphertext []byte) {
	plaintextBytes := []byte(plaintext)

	block, err := aes.NewCipher(key)
	if err != nil {
		panic(err.Error())
	}

	aesgcm, err := cipher.NewGCM(block)
	if err != nil {
		panic(err.Error())
	}

	ciphertext = aesgcm.Seal(nil, nonce, plaintextBytes, nil)
	fmt.Printf("Ciphertext: %x\n", ciphertext)
	fmt.Printf("Nonce: %x\n", nonce)

	return ciphertext
}

// AesGcmDecrypt takes an decryption key, a ciphertext and the corresponding nonce and decrypts it with AES256 in GCM mode. Returns the plaintext string.
func AesGcmDecrypt(ciphertext []byte) (plaintext string) {
	block, err := aes.NewCipher(key)
	if err != nil {
		panic(err.Error())
	}

	aesgcm, err := cipher.NewGCM(block)
	if err != nil {
		panic(err.Error())
	}

	plaintextBytes, err := aesgcm.Open(nil, nonce, ciphertext, nil)
	if err != nil {
		panic(err.Error())
	}

	plaintext = string(plaintextBytes)
	fmt.Printf("%s\n", plaintext)

	return plaintext
}
