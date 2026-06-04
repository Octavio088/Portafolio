//funcion que imprime la ayuda
void ayuda(){
	FILE *ftp;
	char caracter;
	ftp=fopen("ayuda.txt","r");
if(ftp != NULL ){
	do{
     caracter=getc(ftp);
     putchar(toupper(caracter));
     }while(!feof(ftp));	   
    fclose(ftp);
}
else  printf("NO se existe el archivo");
getch();
}
