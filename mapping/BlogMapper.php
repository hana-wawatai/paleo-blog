<?php

/**
 * Description of BookingMapper

 */
class BlogMapper {

    private function __construct() {
        
    }

    /**
     * Maps an array to a blog object.
     * @param Blog $blog
     * @param array $properties
     */
    public static function map(Blog $blog, array $properties) {
        if (array_key_exists('id', $properties)) {
            $blog->setId($properties['id']);
        }

        if (array_key_exists('date_created', $properties)) {
            $dateCreated = self::createDateTime($properties['date_created']);
            if ($dateCreated) {
                $blog->setDateCreated($dateCreated);
            }
        }

        if (array_key_exists('title', $properties)) {
            $blog->setTitle($properties['title']);
        }

        if (array_key_exists('description', $properties)) {
            $blog->setDescription($properties['description']);
        }

        if (array_key_exists('content', $properties)) {
            $blog->setContent($properties['content']);
        }
        if (array_key_exists('user_id', $properties)) {
            $user = new User();

            $user->setId($properties ['user_id']);
            if (array_key_exists('first_name', $properties)) {
                $user->setFirstName($properties['first_name']);
            }

            if (array_key_exists('last_name', $properties)) {
                $user->setLastName($properties ['last_name']);
            }


            $blog->setUserId($properties['user_id']);
        }
    }

    private static function createDateTime($input) {
        return DateTime::createFromFormat('Y-n-j H:i:s', $input);
    }

}
