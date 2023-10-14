package com.example.jspdemo.service;

import com.example.jspdemo.model.Client;
import com.example.jspdemo.repo.ClientRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.ArrayList;
import java.util.List;

@Service
public class ClientService {

    @Autowired
    ClientRepository clientRepo;

    public List<Client> getAllClient() {
        List<Client> clientList = new ArrayList<>();
        clientRepo.findAll().forEach(client -> clientList.add(client));

        return clientList;
    }

    public Client getClientById(int id) {
        return clientRepo.findById(id).get();
    }

    public boolean saveOrUpdateClient(Client client) {
        Client updatedClient = clientRepo.save(client);

        if (clientRepo.findById(updatedClient.getId()) != null) {
            return true;
        }

        return false;
    }

    public boolean deleteClient(int id) {
        clientRepo.deleteById(id);

        if (clientRepo.findById(id) != null) {
            return true;
        }

        return false;
    }

    public boolean orderClient() {

        return true;
    }

}
