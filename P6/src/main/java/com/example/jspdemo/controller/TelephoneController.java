package com.example.jspdemo.controller;

import com.example.jspdemo.model.Telephone;
import com.example.jspdemo.service.TelephoneService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.ModelAttribute;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.servlet.mvc.support.RedirectAttributes;


@Controller
public class TelephoneController {

    @Autowired
    TelephoneService telephoneService;

    @GetMapping({"/telephone", "/viewTelephoneList"})
    public String viewTelephoneList(@ModelAttribute("message") String message, Model model) {
        model.addAttribute("telephoneList", telephoneService.getAllTelephone());
        model.addAttribute("message", message);

        return "ViewTelephoneList";
    }

    @GetMapping("/addTelephone")
    public String addTelephone(@ModelAttribute("message") String message, Model model) {
        model.addAttribute("telephone", new Telephone());
        model.addAttribute("message", message);

        return "AddTelephone";
    }

    @PostMapping("/saveTelephone")
    public String saveTelephone(Telephone telephone, RedirectAttributes redirectAttributes) {
        if (telephoneService.saveOrUpdateTelephone(telephone)) {
            redirectAttributes.addFlashAttribute("message", "Save Success");
            return "redirect:/viewTelephoneList";
        }

        redirectAttributes.addFlashAttribute("message", "Save Failure");
        return "redirect:/addTelephone";
    }

    @GetMapping("/editTelephone/{id}")
    public String editTelephone(@PathVariable int id, Model model) {
        model.addAttribute("telephone", telephoneService.getTelephoneById(id));

        return "EditTelephone";
    }

    @PostMapping("/editSaveTelephone")
    public String editSaveTelephone(Telephone telephone, RedirectAttributes redirectAttributes) {
        if (telephoneService.saveOrUpdateTelephone(telephone)) {
            redirectAttributes.addFlashAttribute("message", "Edit Success");
            return "redirect:/viewTelephoneList";
        }

        redirectAttributes.addFlashAttribute("message", "Edit Failure");
        return "redirect:/editTelephone/" + telephone.getId();
    }

    @GetMapping("/deleteTelephone/{id}")
    public String deleteTelephone(@PathVariable int id, RedirectAttributes redirectAttributes) {
        if (telephoneService.deleteTelephone(id)) {
            redirectAttributes.addFlashAttribute("message", "Delete Success");
        } else {
            redirectAttributes.addFlashAttribute("message", "Delete Failure");
        }

        return "redirect:/viewTelephoneList";
    }

}
