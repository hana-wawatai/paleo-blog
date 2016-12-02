<?php

class Blog {

    private $id;
    private $dateCreated;
    private $title;
    private $description;
    private $content;
    private $status;
    private $userId;


    function getId() {
        return $this->id;
    }

    function getDateCreated() {
        return $this->dateCreated;
    }

    function getTitle() {
        return $this->title;
    }

    function getDescription() {
        return $this->description;
    }

    function getContent() {
        return $this->content;
    }

    function getStatus() {
        return $this->status;
    }

    function getUserId() {
        return $this->userId;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDateCreated($dateCreated) {
        $this->dateCreated = $dateCreated;
    }

    function setTitle($title) {
        $this->title = $title;
    }

    function setDescription($description) {
        $this->description = $description;
    }

    function setContent($content) {
        $this->content = $content;
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function setUserId($userId) {
        $this->userId = $userId;
    }
}