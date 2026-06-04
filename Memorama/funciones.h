void gotoxy(int x,int y);
void texto(int x, int y);
//

void gotoxy(int x,int y){  
      HANDLE hcon;  
      hcon = GetStdHandle(STD_OUTPUT_HANDLE);  
      COORD dwPos;  
      dwPos.X = x;  
      dwPos.Y= y;  
      SetConsoleCursorPosition(hcon,dwPos);  
}

void texto(int x, int y){
do{	
	gotoxy(x,y);
	SetConsoleTextAttribute(GetStdHandle(STD_OUTPUT_HANDLE),244);
	Sleep(300);printf("P");Sleep(300);printf("R");Sleep(300);printf("E");Sleep(300);printf("S");Sleep(300);printf("I");Sleep(300);printf("O");Sleep(300);printf("N");Sleep(300);printf("A");
	printf(" ");Sleep(300);
	printf("E");Sleep(300);printf("N");Sleep(300);printf("T");Sleep(300);printf("E");Sleep(300);printf("R");Sleep(300);printf(" ");Sleep(300);printf("P");Sleep(300);printf("A");Sleep(300);printf("R");
	printf("A");Sleep(300);
	printf(" ");Sleep(300);printf("J");Sleep(300);printf("U");Sleep(300);printf("G");Sleep(300);printf("A");Sleep(300);printf("R");Sleep(300);
	gotoxy(x,y);
	for(int j=0;j<26;j++){
		SetConsoleTextAttribute(GetStdHandle(STD_OUTPUT_HANDLE),15);
		printf("%c",219);
	}
	SetConsoleTextAttribute(GetStdHandle(STD_OUTPUT_HANDLE),244);
}while(!_kbhit());
}

