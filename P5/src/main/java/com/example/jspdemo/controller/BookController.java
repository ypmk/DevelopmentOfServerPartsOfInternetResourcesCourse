package com.example.jspdemo.controller;

import org.springframework.ui.Model;
import com.example.jspdemo.model.Book;
import com.example.jspdemo.service.BookService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.ModelAttribute;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.servlet.mvc.support.RedirectAttributes;


@Controller
public class BookController {

    @Autowired
    BookService bookService;

    @GetMapping({"/book", "/viewBookList"})
    public String viewBookList(@ModelAttribute("message") String message, Model model) {
        model.addAttribute("bookList", bookService.getAllBook());
        model.addAttribute("message", message);

        return "ViewBookList";
    }

    @GetMapping("/addBook")
    public String addBook(@ModelAttribute("message") String message, Model model) {
        model.addAttribute("book", new Book());
        model.addAttribute("message", message);

        return "AddBook";
    }

    @PostMapping("/saveBook")
    public String saveAnime(Book book, RedirectAttributes redirectAttributes) {
        if (bookService.saveOrUpdateBook(book)) {
            redirectAttributes.addFlashAttribute("message", "Save Success");
            return "redirect:/viewBookList";
        }

        redirectAttributes.addFlashAttribute("message", "Save Failure");
        return "redirect:/addBook";
    }

    @GetMapping("/editBook/{id}")
    public String editBook(@PathVariable int id, Model model) {
        model.addAttribute("book", bookService.getBookById(id));

        return "EditBook";
    }

    @PostMapping("/editSaveBook")
    public String editSaveBook(Book book, RedirectAttributes redirectAttributes) {
        if (bookService.saveOrUpdateBook(book)) {
            redirectAttributes.addFlashAttribute("message", "Edit Success");
            return "redirect:/viewBookList";
        }

        redirectAttributes.addFlashAttribute("message", "Edit Failure");
        return "redirect:/editBook/" + book.getId();
    }

    @GetMapping("/deleteBook/{id}")
    public String deleteBook(@PathVariable int id, RedirectAttributes redirectAttributes) {
        if (bookService.deleteBook(id)) {
            redirectAttributes.addFlashAttribute("message", "Delete Success");
        } else {
            redirectAttributes.addFlashAttribute("message", "Delete Failure");
        }

        return "redirect:/viewBookList";
    }

}
