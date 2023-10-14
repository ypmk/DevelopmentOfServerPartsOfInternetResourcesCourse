package com.example.jspdemo.controller;

import com.example.jspdemo.model.WashingMachine;
import com.example.jspdemo.service.WashingMachineService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.ModelAttribute;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.servlet.mvc.support.RedirectAttributes;


@Controller
public class WashingMachineController {

    @Autowired
    WashingMachineService washingMachine;

    @GetMapping({"/washingMachine", "/viewWashingMachineList"})
    public String viewWashingMachineList(@ModelAttribute("message") String message, Model model) {
        model.addAttribute("washingMachineList", washingMachine.getAllWashingMachine());
        model.addAttribute("message", message);

        return "ViewWashingMachineList";
    }

    @GetMapping("/addWashingMachine")
    public String addWashingMachine(@ModelAttribute("message") String message, Model model) {
        model.addAttribute("washingMachine", new WashingMachine());
        model.addAttribute("message", message);

        return "AddWashingMachine";
    }

    @PostMapping("/saveWashingMachine")
    public String saveWashingMachine(WashingMachine washingMachine, RedirectAttributes redirectAttributes) {
        if (this.washingMachine.saveOrUpdateWashingMachine(washingMachine)) {
            redirectAttributes.addFlashAttribute("message", "Save Success");
            return "redirect:/viewWashingMachineList";
        }

        redirectAttributes.addFlashAttribute("message", "Save Failure");
        return "redirect:/addWashingMachine";
    }

    @GetMapping("/editWashingMachine/{id}")
    public String editWashingMachine(@PathVariable int id, Model model) {
        model.addAttribute("washingMachine", washingMachine.getWashingMachineById(id));

        return "EditWashingMachine";
    }

    @PostMapping("/editSaveWashingMachine")
    public String editSaveWashingMachine(WashingMachine washingMachine, RedirectAttributes redirectAttributes) {
        if (this.washingMachine.saveOrUpdateWashingMachine(washingMachine)) {
            redirectAttributes.addFlashAttribute("message", "Edit Success");
            return "redirect:/viewWashingMachineList";
        }

        redirectAttributes.addFlashAttribute("message", "Edit Failure");
        return "redirect:/editWashingMachine/" + washingMachine.getId();
    }

    @GetMapping("/deleteWashingMachine/{id}")
    public String deleteWashingMachine(@PathVariable int id, RedirectAttributes redirectAttributes) {
        if (washingMachine.deleteWashingMachine(id)) {
            redirectAttributes.addFlashAttribute("message", "Delete Success");
        } else {
            redirectAttributes.addFlashAttribute("message", "Delete Failure");
        }

        return "redirect:/viewWashingMachineList";
    }

}
