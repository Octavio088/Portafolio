#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include "BynaryTree.h"

BNode* create_bnode(int k) {
	BNode *x = (BNode*)malloc(sizeof(BNode));
	x->key = k;
	x->left = NULL;
	x->right = NULL;
	x->p = NULL;
	x->height = 1;
	return x;
}

void tree_insert(BTree *T, BNode *z) {
	BNode *y = NULL;
	BNode *x = T->root;
	while ( x != NULL ) {
		y = x;
		if ( z->key < x->key )
			x = x->left;
		else x = x->right;
	}
	z->p = y;
	if ( y == NULL )
		T->root = z;
	else if ( z->key < y->key )
		y->left = z;
	else y->right = z;
}

BNode* tree_minimum(BNode *x) {
	while ( x->left != NULL) {
		x = x->left;
	}
	return x;
}

void transplant(BTree *T, BNode *u, BNode *v) {
	if (u->p == NULL)
		T->root = v;
	else if (u == u->p->left) 
		u->p->left = v;
	else u->p->right = v;
	if (v != NULL)
		v->p = u->p;
}

void tree_delete(BTree *T, BNode *z) {
	if (z->left == NULL) 
		transplant(T, z, z->right);
	else if (z->right == NULL)
		transplant(T, z, z->left);
	else {
		BNode *y = tree_minimum(z->right);
		if (y->p != z) {
			transplant(T, y, y->right);
			y->right = z->right;
			y->right->p = y;
		}
		transplant(T, z, y);
		y->left = z->left;
		y->left->p = y;
	}
	free(z);
}

void cpy(char *dest, char *source, int n) {
	int i;
	for (i = 0; i < n; i++)
		dest[i] = source[i];
}

NHuffman* extractMin(BTree *Q) {
	BNode *min = tree_minimum(Q->root);
	NHuffman *n = min->huffman;
	tree_delete(Q, min);
	return n;
}

NHuffman *create_nhuffman(char c, int freq, NHuffman *left, NHuffman *right) {
	NHuffman *z = (NHuffman*)malloc(sizeof(NHuffman));
	z->freq = freq;
	z->symbol = c;
	z->left = left;
	z->right = right;
	return z;
}

NHuffman* Huffman(NHuffman **C, int n) {
	BTree *Q = (BTree*)malloc(sizeof(BTree));
	Q->root = NULL;
	int i;
	for (i = 0; i < n; i++) {
		BNode *x = create_bnode(C[i]->freq);
		x->huffman = C[i];
		tree_insert(Q, x);
	}
	for (i = 0; i < n-1; i++) {
		NHuffman *x = extractMin(Q);
		NHuffman *y = extractMin(Q);
		NHuffman *z = create_nhuffman(-1, x->freq + y->freq, x, y);
		BNode *n = create_bnode(z->freq);
		n->huffman = z;
		tree_insert(Q, n);
	}
	return extractMin(Q);
}

void escribeByte(unsigned char* byte, int bit,int* indice, FILE*archivo_comprimido,bool cierre){

	if(bit == 1){
		*byte= *byte|(1<<*indice);
	}
	(*indice)++;
	
	if (*indice == 8) {
        fwrite(byte, sizeof(unsigned char),1, archivo_comprimido);
        *byte = 0;
        *indice = 0;
    }else if(*indice != 8 && *indice!=0 && cierre){
    	fwrite(byte, sizeof(unsigned char),1, archivo_comprimido);
    	*indice=0;
	}
}

void inorder_huffman(NHuffman *x, char* codigo, int i, char *binario[]){
	if (x != NULL) {
		char *l = (char*)malloc((i+2)*sizeof(char));
		char *r = (char*)malloc((i+2)*sizeof(char));
		cpy(l, codigo, i);
		cpy(r, codigo, i);
		l[i] = '0';
		r[i] = '1';
		
		inorder_huffman(x->left, l, i+1,binario);
		if (x->symbol != -1) {
			codigo[i] = '\0';
			printf("%c: %s ->Frecuencia:%d\n", x->symbol, codigo,x->freq);
			binario[(char)x->symbol] = strdup(codigo);
		}
		inorder_huffman(x->right, r, i+1,binario);
	}
}
