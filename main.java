import java.sql.*;
import java.util.*;
import java.nio.file.Files;
import java.nio.file.Paths;
import org.jsoup.Jsoup;
import java.io.File;  

import java.nio.charset.StandardCharsets;
import java.io.*;
import org.jsoup.Jsoup;
import org.jsoup.nodes.Document;
import org.jsoup.nodes.Element;
import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
class main{
    public static void main(String args[]) throws IOException
    {      
	    int count = 0;           
      	    String host = "undcsmysql.mysql.database.azure.com";
	    String user ="b.shrestha@undcsmysql";
	    String password ="bshrestha9152";
	    String database="b_shrestha";	

	    int limit =Integer.parseInt(args[0]);
            String URL = args[1];
	    System.out.println(URL);

           ProcessBuilder processBuilder = new ProcessBuilder();
	   System.out.println("lynx -listonly -nonumbers -unique_urls -dump '" + URL + "'  | sort | uniq | grep -oe '"+ URL + "[^ ]*' > final.txt ");
           processBuilder.command("bash","-c", "lynx -listonly -nonumbers -unique_urls -dump '" + URL + "'  | sort | uniq | grep -oe '"+ URL + "[^ ]*' > result.txt ");
	  try {
            Process process = processBuilder.start();
        
            process.waitFor();
	 } catch (IOException e) {
            e.printStackTrace();
         } catch (InterruptedException e) {
            e.printStackTrace();
         }
         ProcessBuilder processBuilder1 = new ProcessBuilder();
         processBuilder1.command("bash","-c", "sort result.txt copy_result.txt | uniq > final.txt");
        try {
           Process process1 = processBuilder1.start();
           ProcessBuilder processBuilder2 = new ProcessBuilder();
           processBuilder2.command("bash","-c", "cat final.txt > copy_result.txt");
           Process process2 = processBuilder2.start();
           process1.waitFor();
           process2.waitFor();
        } catch (IOException e) {
            e.printStackTrace();
        } catch (InterruptedException e) {
            e.printStackTrace();
        }

	ArrayList<String> list = new ArrayList<String>();
	try (BufferedReader br = new BufferedReader(new FileReader("final.txt")))
        {

            String sCurrentLine;

            while ((sCurrentLine = br.readLine()) != null) {
                list.add(sCurrentLine);
            }

        } catch (IOException e) {
            e.printStackTrace();
        } 
       count = list.size();
      System.out.println(count);
      if(count < limit){
	for(String part: list) {
		System.out.println("lynx -listonly -nonumbers -unique_urls -dump '" + part + "'  | sort | uniq | grep -oe '"+ URL + "[^ ]*' > result.txt ");
	   processBuilder.command("bash","-c", "lynx -listonly -nonumbers -unique_urls -dump '" + part + "'  | sort | uniq | grep -oe '"+ URL + "[^ ]*' > result.txt ");
	   try {
              Process process = processBuilder.start();

              process.waitFor();
	ProcessBuilder processBuilder3 = new ProcessBuilder();
        processBuilder3.command("bash","-c", "sort result.txt copy_result.txt | uniq > final.txt");
        try {
           Process process3 = processBuilder3.start();
        ProcessBuilder processBuilder4 = new ProcessBuilder();
        processBuilder4.command("bash","-c", "cat final.txt > copy_result.txt");
         Process process4 = processBuilder4.start();


         process3.waitFor();
         process4.waitFor();
        } catch (IOException e) {
            e.printStackTrace();
        } catch (InterruptedException e) {
            e.printStackTrace();
        }


              } catch (IOException e) {
      	      e.printStackTrace();
              } catch (InterruptedException e) {
                e.printStackTrace();
              }

		
	}

}
	ArrayList<String> finalList = new ArrayList<String>();
        try (BufferedReader br = new BufferedReader(new FileReader("final.txt")))
        {

            String sCurrentLine;

            while ((sCurrentLine = br.readLine()) != null) {
                finalList.add(sCurrentLine);
            }

	} catch (IOException e) {
            e.printStackTrace();
        }
   //     for(String final: finalList) {
for (int i = 0; i < finalList.size(); i++) {
        ProcessBuilder processBuilder6 = new ProcessBuilder();
        System.out.println("lynx -dump -source '" + finalList.get(i) + "' > resultfile.html");
        processBuilder6.command("bash","-c", "lynx -dump -source '" + finalList.get(i) + "' > resultfile.html ");
        try {
           Process process6 = processBuilder.start();

         int time = process6.waitFor();
        } catch (IOException e) {
            e.printStackTrace();
        } catch (InterruptedException e) {
            e.printStackTrace();
        }
	if (time == 0){
	Document document = Jsoup.parse(new File("resultfile.html"),"utf-8");

        String data = document.text();
        System.out.println(data);    
          }

}

















}

}
