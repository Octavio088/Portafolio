#ifndef _BINARY_TREE_H_
#define _BINARY_TREE_H_

#include <stdio.h>

struct nHuffman {
	int freq;
	struct nHuffman *left, *right;
	int symbol;
};

typedef struct nHuffman NHuffman;

struct bNode {
	int key;
	int height;
	struct bNode *left;
	struct bNode *right;
	struct bNode *p;
	NHuffman *huffman;
};

typedef struct bNode BNode;

struct bTree {
	BNode *root;
};

typedef struct bTree BTree;

BNode* create_bnode(int k);
BNode* tree_minimum(BNode*);
BNode* tree_maximum(BNode*);
BNode* tree_successor(BNode*);
BNode* tree_predecessor(BNode*);
void tree_insert(BTree*, BNode*);
void tree_delete(BTree*, BNode*);
void tree_free(BNode*);

void avltree_insert(BTree *, BNode *);
void avltree_delete(BTree*, BNode *);



NHuffman* create_nhuffman(char, int, NHuffman*,NHuffman*);
void escribeByte(unsigned char*, int,int*,FILE*,bool);
void escribeBite(unsigned char*, int,int*,FILE*,bool);
void inorder_huffman(NHuffman*, char*, int,char**);
NHuffman* Huffman(NHuffman **C, int);



#endif
