<?php

use \PHPUnit\Framework\TestCase;
include './src/MerkleTree.php';


/**
 * These tests will only work with one sha256 hash.  If you apply double hashing, obviously they will fail.
 */
class MerkleTreeTest extends TestCase
{

    /**
     * Create the Merkle tree object, add some elements, and check the root is as expected.
     *
     * This test will work with a single hash.  If double hashing is applied it won't work.
     *
     * @covers MerkleTree
     * @return void
     */
    public function test_merkle_root_is_ok()
    {
        $merkle_tree = new MerkleTree();
        $this->assertInstanceOf('MerkleTree', $merkle_tree);

        $merkle_tree->addElement('abc');  // ba7816bf8f01cfea414140de5dae2223b00361a396177a9cb410ff61f20015ad
        $merkle_tree->addElement('def');  // cb8379ac2098aa165029e3938a51da0bcecfc008fd6795f401178647f96c5b34
        $merkle_tree->addElement('ghi');  // 50ae61e841fac4e8f9e40baf2ad36ec868922ea48368c18f9535e47db56dd7fb
        $merkle_tree->addElement('jkl');  // 268f277c6d766d31334fda0f7a5533a185598d269e61c76a805870244828a5f1

        // abc + def => c4e66df524678be2ce0ac784f9cd63c1f9f888f802808b4881114855783812a5
        // ghi + jkl => 00ad25f0fc0a7445263ae9622abfd1b2f958c51a5f6bcc95c33914af44a23dbf

        // abcdef + ghijkl => 53804d89bf13aa7560f59e00e0c0e39cdcf0e1e02f5e7875bd5c6108dc2404f7

        $merkle_tree->create();

        $merkle_root = $merkle_tree->getRoot();

        $this->assertEquals('53804d89bf13aa7560f59e00e0c0e39cdcf0e1e02f5e7875bd5c6108dc2404f7', $merkle_root);
    }


    /**
     * Create the Merkle tree object, add some elements, and check the root is as expected.
     *
     * This test will work with a single hash.  If double hashing is applied it won't work.
     *
     * @covers MerkleTree
     * @return void
     */
    public function test_merkle_root_is_ok_with_odd_number_of_elements()
    {
        $merkle_tree = new MerkleTree();
        $this->assertInstanceOf('MerkleTree', $merkle_tree);

        $merkle_tree->addElement('abc');  // ba7816bf8f01cfea414140de5dae2223b00361a396177a9cb410ff61f20015ad
        $merkle_tree->addElement('def');  // cb8379ac2098aa165029e3938a51da0bcecfc008fd6795f401178647f96c5b34
        $merkle_tree->addElement('ghi');  // 50ae61e841fac4e8f9e40baf2ad36ec868922ea48368c18f9535e47db56dd7fb
        $merkle_tree->addElement('jkl');  // 268f277c6d766d31334fda0f7a5533a185598d269e61c76a805870244828a5f1
        $merkle_tree->addElement('mno');  // cf63b8eb216845d24edd4b249b146957b42199cd12759647df90cb57525b4e90

        // abc + def => c4e66df524678be2ce0ac784f9cd63c1f9f888f802808b4881114855783812a5
        // ghi + jkl => 00ad25f0fc0a7445263ae9622abfd1b2f958c51a5f6bcc95c33914af44a23dbf
        // mno + mno => 9cfeecba2a7148d2798e8d2262802d558316fbcd99e0070436c8cabda9afa584

        // abcdef + ghijkl => 53804d89bf13aa7560f59e00e0c0e39cdcf0e1e02f5e7875bd5c6108dc2404f7
        // mnomno + mnomno => 98ecd7413244113b3142c3ac9c6868bfa10367b1fbb4a72c1836edc3086e2960

        // abcdefghijkl + mnomnomnomno => 275f4a9d4aa42bdb6f743c03a81970cb023873cc404de8dc6e82e2a3610e66ac

        $merkle_tree->create();

        $merkle_root = $merkle_tree->getRoot();

        $this->assertEquals('275f4a9d4aa42bdb6f743c03a81970cb023873cc404de8dc6e82e2a3610e66ac', $merkle_root);
    }


}