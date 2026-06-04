#include<stdio.h>
#include<conio.h>
#include<windows.h>
#include<stdlib.h>
#include <string.h>
#include "BynaryTree.h"

/* run this program using the console pauser or add your own getch, system("pause") or input loop */

int main(int argc, char** argv) {
	
		
	if(argc != 4){//validamos que se pasen los 4 parametros --- .exe --- opcion de comprimir(1) o descomprimir(2) --- archivo base --- archivo nuevo
		fprintf(stderr,"Uso: %s <nombre_del_archivo>\n",argv[0]);
		return 1;
	}
	
	int opcion = atoi(argv[1]);//asignamos el valor 1 o 2 para saber que proceso se va a realizar
	
	if(opcion==1){//si opcion es igual a 1, realizamos la compresión
		printf("Compresion elegida\n");
		FILE *archivo_normal;//declaramos los dos archivos necesarios para realizar el proceso
		FILE *archivo_comprimido;
		
		archivo_normal=fopen(argv[2],"rb");//abrimos los dos archivos necesarios para realizar el proceso
		archivo_comprimido=fopen(argv[3],"wb");
		
		if (archivo_normal == NULL) {//validamos que los dosarchivos se hayan abierto correctamente
            printf("Error al abrir el archivo normal.\n");
            return 1;
        }

        if (archivo_comprimido == NULL) {
            printf("Error al abrir el archivo comprimido.\n");
            fclose(archivo_normal);
            return 1;
        }
        
		int caracter;//declaracion de variables necesarias para la compresion
		char letra[256]={0};
		unsigned long frecuencias[256]={0};
		int contador_nodos=0;
		char codigo[]="";
		char *binario[256]={0};
		unsigned char byte=0;
		bool cierre=false;
		int bit;
		int indice=0;
		unsigned char separacion = 0xFF;
		NHuffman *C[256];
			
		while((caracter = fgetc(archivo_normal)) != EOF){//calculamos las frecuencias de cada caracter basandonos en el codigo ascii (la posicion)
			for(int j=0;j<256;j++){
				letra[j]=j;
				if(caracter == j){
					frecuencias[j]++;
				}
			}
		}
			
		for(int i=0;i<256;i++){//creamos los nodos usando las frecuencias y las letras que se calcularon anteriormente
			if(frecuencias[i] != 0){
				C[contador_nodos] = create_nhuffman(letra[i],frecuencias[i],NULL,NULL);
				contador_nodos++;
			}
		}
			
		NHuffman *n = Huffman(C,contador_nodos);//creamos el arbol Huffman
		
		for(int f=0;f<256;f++){//escribimos la cabecera de frecuencias, unicamente las frecuencias necesarias para el arbol
			unsigned long freq;
			unsigned char let;
			if(frecuencias[f]!=0){//para saber que frecuencia corresponde a tal caracter, imprimimos este caracter antes de su frecuencia correspondiente
				freq=frecuencias[f];
				let=letra[f];
				
				fwrite(&let, sizeof(unsigned char), 1, archivo_comprimido);
				fwrite(&freq, sizeof(unsigned long), 1, archivo_comprimido);
			}
		}
		
		fwrite(&separacion, sizeof(unsigned char), 1, archivo_comprimido);//usamos la varaible separacion con valor 0xFF para separar las frecuencias de los bytes que contienen los codigos
		
		inorder_huffman(n,codigo,0,binario);//usamos inorder para obtener los codigos necesarios, a este le pasamos la variable binario para guardar los codigos de cada caracter
		
		rewind(archivo_normal);//reseteamos el apuntador del archivo normal para escribir los codigos conforme el orden del archivo
		
		while((caracter = fgetc(archivo_normal)) != EOF){//buscamos el codigo del caracter y los escribimos con bit por bit en la funcion escribeByte
			for(int k=0;k<256;k++){
				if(caracter==k){
					char *binarios;
					binarios=binario[k];
					for(int l=0;binarios[l]!='\0';l++){
						bit=binarios[l];
						bit=bit-48;
						escribeByte(&byte,bit,&indice,archivo_comprimido,cierre);
					}
					break;
				}
			}
		}
		cierre=true;//si la variable cierre es verdadera, quiere decir que acabamos de leer el archivo original y revisamos si quedaron bytes sin imprimir para poder imprimirlos
		escribeByte(&byte,0,&indice,archivo_comprimido,cierre);
		
		for (int i = 0; i < 256; i++) {//liberamos la variable binario
		    if (binario[i] != NULL) {
		        free(binario[i]);
		    }
		}
		
		fclose(archivo_normal);//cerramos los archivos necesarios
		fclose(archivo_comprimido);
		
	}else{//si opcion es diferente de 1, realizamos la descompresion
		printf("Descompresion elegida\n");
		
		FILE *archivo_comprimido;//declaramos los dos archivos necesarios para realizar el proceso
		FILE *archivo_descomprimido;
		
		archivo_comprimido=fopen(argv[2],"rb");//abrimos los dos archivos necesarios para realizar el proceso
		archivo_descomprimido=fopen(argv[3],"wb");
		
		unsigned long freq;//variables necesarias para el proceso
		unsigned char let;
		char letra[256]={0};
		unsigned long frecuencias[256]={0};
		int contador_nodos=0;
		char codigo[]="";
		char *binario[256]={0};
		unsigned char byte=0;
		bool cierre=false;
		int bit;
		int indice=0;
		NHuffman *S[256];
		
		while(fread(&let,sizeof(unsigned char),1,archivo_comprimido)){//leemos primeramente las frecuencias y el caracter al que corresponden
			if(let==0xFF){//si llegamos al separador, detenemos la lectura de frecuencias
				break;
			}
			
			for(int i=0;i<256;i++){//asignamos el caracter y/o l frecuencia a susrespectivas cadenas y arreglos en la posicion requerida
				if(i==let){
					letra[i]=let;
					if(fread(&freq,sizeof(unsigned long),1,archivo_comprimido)==1){
						frecuencias[i]=freq;
					}
					break;
				}
			}
		}
		
		for(int i=0;i<256;i++){//creamos los nodos usando los caracteres y frecuencias que ya obtuvimos
			if(frecuencias[i] != 0){
				S[contador_nodos] = create_nhuffman(letra[i],frecuencias[i],NULL,NULL);
				contador_nodos++;
			}
		}
		
		NHuffman *m = Huffman(S,contador_nodos);//creamos el arbol nuevamente
		NHuffman *current = m;//usamos un current para apoyarnos en el recorrido del arbol
		
		int z=0;//leemos bit por bit apoyandonos del archivo que queremos comprimir y los bytes que este contiene
		while((z=fgetc(archivo_comprimido)) != EOF){
			int x;
			byte=(unsigned char)z;
			for(x=0;x<8;x++){//recorremos el arbol dependiendo del valor del bit
				bit=(byte >> x)&1;
				if(bit==0){
					current=current->left;
				}else{
					current=current->right;
				}
				if(current->left==NULL && current->right ==NULL){//al llegar a un nodo hoja imprimimos el caracter		
					printf("es...%c\n",current->symbol);
					fputc(current->symbol,archivo_descomprimido);
					current=m;//reseteamos current
				}
			}
		}
		
		fclose(archivo_comprimido);//cerramos los archivos necesarios
		fclose(archivo_descomprimido);
	}
	
	return 0;
}
