<?php

class MerkleTree
{

    private $element_list;
    private $root;


    public function __construct()
    {
        $this->element_list = array();
        $this->root         = "";
    }


    /**
     * Add an element to the Merkle Tree.  This method automatically generates the
     * hash of the element and adds it as a leaf of the Merkle tree.
     *
     * @param Mixed $element
     * @return void
     */
    public function addElement($element)
    {
        $this->element_list[] = $this->hash($element);
    }


    /**
     * Loop through all the created leaves and start building the tree.
     *
     * @return void
     */
    public function create()
    {
        $new_list = $this->element_list;

        // This is simply "going up one level".
        while (count($new_list) != 1) {
            $new_list = $this->getNewList($new_list);
        }

        $this->root = $new_list[0];
    }


    /**
     * This method creates the parent level of the current nodes (or leaves).
     * If there is no right sibling, then the left element is re-used.
     *
     * @param Array $temp_list
     * @return void
     */
    private function getNewList($temp_list)
    {
        $i        = 0;
        $new_list = array();

        while ($i < count($temp_list)) {
            // Left child
            $left = $temp_list[$i];
            $i++;

            // Right child
            if ($i != count($temp_list)) {
                $right = $temp_list[$i];
            } else {
                $right = $left;
            }

            // Hash and add as parent.
            $hash_value = $this->hash($left . $right);

            $new_list[] = $hash_value;
            $i++;
        }

        return $new_list;
    }


    /**
     * The hash function is pretty simple.  Change this to your convenience.
     * i.e. Bitcoin uses double sha256 hashing.
     *
     * @return String hash  The hashed result
     */
    private function hash($string)
    {
        // Bitcoin's method
        // return hash('sha256', hash('sha256', $string, false), false);

        return hash('sha256', $string, false);
    }


    /**
     * The root is already calculated when creating the tree.  Here we just return it.
     *
     * @return String  The Merkle Root
     */
    public function getRoot()
    {
        return $this->root;
    }


}
