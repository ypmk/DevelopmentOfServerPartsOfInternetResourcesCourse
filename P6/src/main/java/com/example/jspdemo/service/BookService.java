package com.example.jspdemo.service;

import com.example.jspdemo.model.Book;
import com.example.jspdemo.model.Cart;
import com.example.jspdemo.model.Ordering;
import com.example.jspdemo.repo.BookRepository;
import com.example.jspdemo.repo.CartRepository;
import com.example.jspdemo.repo.OrderingRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.ArrayList;
import java.util.List;

@Service
public class BookService {

    @Autowired
    BookRepository bookRepo;
    @Autowired
    CartRepository cartRepo;
    @Autowired
    OrderingRepository orderingRepo;


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

    public boolean addBookToCart(Book book) {

        if (book.available.equals("yes")){
            Ordering ordering = new Ordering();
            ordering.name = book.name;
            ordering.price = book.price;
            ordering.productType = book.productType;
            orderingRepo.save(ordering);
        }


        Cart inCart = new Cart();
        inCart.name = book.name;
        inCart.price = book.price;
        inCart.productType = book.productType;
        inCart.available = book.available;
        inCart.quantity ++;
        cartRepo.save(inCart);
        return true;

    }

    public boolean deleteBook(int id) {
        bookRepo.deleteById(id);

        if (bookRepo.findById(id) != null) {
            return true;
        }

        return false;
    }



}
