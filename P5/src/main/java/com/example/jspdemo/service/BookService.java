package com.example.jspdemo.service;

import com.example.jspdemo.model.Book;
import com.example.jspdemo.repo.BookRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.ArrayList;
import java.util.List;

@Service
public class BookService {

    @Autowired
    BookRepository bookRepo;

    public List<Book> getAllBook() {
        List<Book> bookList = new ArrayList<>();
        bookRepo.findAll().forEach(book -> bookList.add(book));

        return bookList;
    }

    public Book getBookById(int id) {
        return bookRepo.findById(id).get();
    }

    public boolean saveOrUpdateBook(Book book) {
        Book updatedBook = bookRepo.save(book);

        if (bookRepo.findById(updatedBook.getId()) != null) {
            return true;
        }

        return false;
    }

    public boolean deleteBook(int id) {
        bookRepo.deleteById(id);

        if (bookRepo.findById(id) != null) {
            return true;
        }

        return false;
    }

}
