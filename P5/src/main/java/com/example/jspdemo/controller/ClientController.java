package com.example.jspdemo.controller;

import com.example.jspdemo.service.ClientService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.*;
import com.example.jspdemo.model.Client;
import org.springframework.web.servlet.mvc.support.RedirectAttributes;


@Controller
public class ClientController {

    @Autowired
    ClientService clientService;

    @GetMapping({"/client", "/viewClientList"})
    public String viewClientList(@ModelAttribute("message") String message, Model model) {
        model.addAttribute("clientList", clientService.getAllClient());
        model.addAttribute("message", message);

        return "ViewClientList";
    }

    @GetMapping("/addClient")
    public String addClient(@ModelAttribute("message") String message, Model model) {
        model.addAttribute("client", new Client());
        model.addAttribute("message", message);

        return "AddClient";
    }

    @PostMapping("/saveClient")
    public String saveClient(Client client, RedirectAttributes redirectAttributes) {
        if (clientService.saveOrUpdateClient(client)) {
            redirectAttributes.addFlashAttribute("message", "Save Success");
            return "redirect:/viewClientList";
        }

        redirectAttributes.addFlashAttribute("message", "Save Failure");
        return "redirect:/addClient";
    }

    @GetMapping("/editClient/{id}")
    public String editClient(@PathVariable int id, Model model) {
        model.addAttribute("client", clientService.getClientById(id));

        return "EditClient";
    }

    @PostMapping("/editSaveClient")
    public String editSaveBook(Client client, RedirectAttributes redirectAttributes) {
        if (clientService.saveOrUpdateClient(client)) {
            redirectAttributes.addFlashAttribute("message", "Edit Success");
            return "redirect:/viewClientList";
        }

        redirectAttributes.addFlashAttribute("message", "Edit Failure");
        return "redirect:/editClient/" + client.getId();
    }

    @GetMapping("/deleteClient/{id}")
    public String deleteClient(@PathVariable int id, RedirectAttributes redirectAttributes) {
        if (clientService.deleteClient(id)) {
            redirectAttributes.addFlashAttribute("message", "Delete Success");
        } else {
            redirectAttributes.addFlashAttribute("message", "Delete Failure");
        }

        return "redirect:/viewClientList";
    }

}
