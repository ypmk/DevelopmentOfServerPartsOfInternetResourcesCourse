package com.example.jspdemo.repo;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;
import com.example.jspdemo.model.Client;

@Repository
public interface ClientRepository extends JpaRepository<Client, Integer> {
}
