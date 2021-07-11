<?php

include './src/MerkleTree.php';


$merkle_tree = new MerkleTree();
$merkle_tree->addElement('abc');  // ba7816bf8f01cfea414140de5dae2223b00361a396177a9cb410ff61f20015ad
$merkle_tree->addElement('def');  // cb8379ac2098aa165029e3938a51da0bcecfc008fd6795f401178647f96c5b34
$merkle_tree->addElement('ghi');  // 50ae61e841fac4e8f9e40baf2ad36ec868922ea48368c18f9535e47db56dd7fb
$merkle_tree->addElement('jkl');  // 268f277c6d766d31334fda0f7a5533a185598d269e61c76a805870244828a5f1
$merkle_tree->addElement('mno');  // 268f277c6d766d31334fda0f7a5533a185598d269e61c76a805870244828a5f1

// abc + def => c4e66df524678be2ce0ac784f9cd63c1f9f888f802808b4881114855783812a5
// $merkle_tree->addElement('ba7816bf8f01cfea414140de5dae2223b00361a396177a9cb410ff61f20015adcb8379ac2098aa165029e3938a51da0bcecfc008fd6795f401178647f96c5b34');  // c4e66df524678be2ce0ac784f9cd63c1f9f888f802808b4881114855783812a5
// ghi + jkl => 00ad25f0fc0a7445263ae9622abfd1b2f958c51a5f6bcc95c33914af44a23dbf
// $merkle_tree->addElement('50ae61e841fac4e8f9e40baf2ad36ec868922ea48368c18f9535e47db56dd7fb268f277c6d766d31334fda0f7a5533a185598d269e61c76a805870244828a5f1');  // 00ad25f0fc0a7445263ae9622abfd1b2f958c51a5f6bcc95c33914af44a23dbf

// abcdef + ghijkl => 53804d89bf13aa7560f59e00e0c0e39cdcf0e1e02f5e7875bd5c6108dc2404f7

$merkle_tree->create();

$merkle_root = $merkle_tree->getRoot();

echo "The merkle root for given data is: $merkle_root\n";