  import java.sql.*;
  import java.sql.Statement;
  import java.util.*;
  import java.nio.file.Files;
  import java.nio.file.Paths;
  import org.jsoup.Jsoup;
  import org.jsoup.nodes.Element;
  import org.jsoup.select.Elements;
  import java.io.File;  
  import java.util.List;
  import java.util.ArrayList;
  import java.util.stream.*;
  import java.util.LinkedList;
  import java.util.Properties;
  import java.util.*;
  import java.nio.charset.StandardCharsets;
  import java.io.*;
  import org.jsoup.Jsoup;
  import org.jsoup.nodes.Document;
  import org.jsoup.nodes.Element;
  import java.io.BufferedReader;
  import java.io.IOException;
  import java.io.InputStreamReader;
  class mainfile{
      public static void main(String args[]) throws IOException
      {      int time;
  	    int count = 0;           
	String url, title, keywordsmeta, description, kid, urlID;
urlID = "";
kid= "";
        Map <String, Integer> map = new HashMap<>(); 
//        ArrayList<String> keywords = new ArrayList<String>();
//        Class.forName("com.mysql.jdbc.Driver");
/**	try{
        Class.forName("com.mysql.jdbc.Driver");
        Class.forName("com.mysql.jdbc.Driver");

        String host = "jdbc:mysql://undcsmysql.mysql.database.azure.com:3306/";
  	    String user ="b.shrestha@undcsmysql";
  	    String password ="bshrestha9152";
  	    String database="b_shrestha";	
//        Connection conn = DriverManager.getConnection(host+database,user,password);

  //      Statement stm = conn.createStatement();
		 System.out.println("<br/><br/><b>");

        System.out.println("Connected");

	}
      catch(SQLException e){
         e.printStackTrace();
      }**/
        Process Process;
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
        processBuilder.command("bash","-c", "sort result.txt copy_result.txt | uniq > final.txt");
          try {
              Process process1 = processBuilder.start();
              processBuilder = new ProcessBuilder();
               process1.waitFor();
             processBuilder.command("bash","-c", "cat final.txt > copy_result.txt");
              Process process2 = processBuilder.start();
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
	 System.out.println("<br/><br/><b>");

        System.out.println(count);
        if(count < limit){
      	for(String part: list) {
      		System.out.println("lynx -listonly -nonumbers -unique_urls -dump '" + part + "'  | sort | uniq | grep -oe '"+ URL + "[^ ]*' > result.txt ");
      	   processBuilder.command("bash","-c", "lynx -listonly -nonumbers -unique_urls -dump '" + part + "'  | sort | uniq | grep -oe '"+ URL + "[^ ]*' > result.txt ");
      	   try {
                     Process process3 = processBuilder.start();

                    process3.waitFor();
              processBuilder.command("bash","-c", "sort result.txt copy_result.txt | uniq > final.txt");
              try {
                Process process4= processBuilder.start();
               processBuilder = new ProcessBuilder();
              processBuilder.command("bash","-c", "cat final.txt > copy_result.txt");
                Process process5= processBuilder.start();


               process4.waitFor();
               process5.waitFor();
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
		if(i == limit){
		break;
		}
                System.out.println("lynx -dump -source '" + finalList.get(i) + "' > resultfile.html");
                processBuilder.command("bash","-c", "lynx -dump -source '" + finalList.get(i) + "' > resultfile.html");
                try {
                    Process process6 = processBuilder.start();

                   process6.waitFor();
		 //if (time == 0){
                   Document document = Jsoup.parse(new File("resultfile.html"),"utf-8");

                  String data = document.text();
	                 data = data.replaceAll("[^a-zA-Z0-9\\s+]", "");
	                title="";

	                title = document.title();
		              System.out.println("<br/><br/><b>");

		              System.out.println(title);
                 System.out.println("<br/><br/><b>");

      	        url = finalList.get(i);
              	Elements elementskey= document.select("meta[name=keywords]");
      	        keywordsmeta = elementskey.first().attr("content");
              	Elements elementsdesc = document.select("meta[name=description]");
      	        description = elementsdesc.first().attr("content");
		
                List<String> stopwords = Files.readAllLines(Paths.get("stopwords.txt"));
	               ArrayList<String> keywordstring =Stream.of(data.toLowerCase().split(" ")).collect(Collectors.toCollection(ArrayList<String>::new));
                 System.out.println("<br/><br/><b>");

                System.out.println(keywordstring.size()+ "before");
	             keywordstring.removeAll(stopwords); 

        	        int occurence = 0;
      	        int countKeywords = 0;
              	ArrayList<String> keywords = new ArrayList<String>();

              	for(String word: keywordstring){
               
      	           if(map.containsKey(word)){

      	              count = map.get(word);
                            map.put(word, ++count)	;

      	           }	 
      	           else{
      	
              	      map.put(word, 1);
      	           }}
      		LinkedHashMap<String, Integer> reverseSortedMap = new LinkedHashMap<>();
             
            		//Use Comparator.reverseOrder() for reverse ordering
            		map.entrySet()
                		.stream()
            	    	.sorted(Map.Entry.comparingByValue(Comparator.reverseOrder())) 
                		.forEachOrdered(x -> reverseSortedMap.put(x.getKey(), x.getValue()));
             
            //		System.out.println("Reverse Sorted Map   : " + reverseSortedMap);


            		 for (Map.Entry<String, Integer> map2: reverseSortedMap.entrySet()){

            	           if (countKeywords<100){

            	               keywords.add(map2.getKey());
            		       System.out.println(map2.getKey() );
                    	       countKeywords++;
                       	  }
                       
            	        
            		}
                System.out.print("\n");
                           System.out.println(keywords.size());
            	url = finalList.get(i);
            		 System.out.println("<br/><br/><b>");

      try{
        String host = "jdbc:mysql://undcsmysql.mysql.database.azure.com:3306/";
            String user ="b.shrestha@undcsmysql";
            String password ="bshrestha9152";
            String database="b_shrestha";
           Connection conn = DriverManager.getConnection(host+database,user,password);
          Statement stmt4 = conn.createStatement();
          ResultSet rset4 = stmt4.executeQuery("SELECT urlID from maintable WHERE url='"+ url +"';");
	 System.out.println("SELECT urlID from maintable WHERE url='"+ url +"';");

	 if (!rset4.isBeforeFirst() ) {    
	          Statement stmt5 = conn.createStatement();

          stmt5.executeUpdate("INSERT INTO maintable(url, title, keyword, description) VALUES ('"+ url +"', '"+ title +"','"+keywordsmeta+"','"+description+"');");
          stmt5.close();
          Statement stmt6 = conn.createStatement();
          ResultSet rset5 = stmt6.executeQuery("SELECT urlID from maintable WHERE url='"+ url +"';");
	System.out.println("SELECT urlID from maintable WHERE url='"+ url +"';");
         while(rset5.next()){
          urlID = rset5.getString(1);
	// urlID = Integer.toString(rset5.getInt(1));


          }
          rset5.close();
          stmt6.close();

          

	}else{

             while(rset4.next()){
          urlID = rset4.getString(1);
          }
          //rset4.close();
         }

rset4.close();
stmt4.close();

      

//        Elements elementskey= document.select("meta[name=keywords]");
//	keywordsmeta = elementskey.first().attr("content");
  //      Elements elementsdesc = document.select("meta[name=description]");
   //     description = elementsdesc.first().attr("content");
//	System.out.println(description);
        	for(String keysingle : keywords){
                  Statement stmt0 = conn.createStatement();
                  ResultSet rset0 = stmt0.executeQuery("SELECT kID from keywordssingle WHERE keywords='"+ keysingle +"';");
        	 System.out.print("SELECT kID from keywordssingle WHERE keywords='"+ keysingle +"';");
                         System.out.println("<br/><br/><b>");
        //        String kid="";   
                 if (!rset0.isBeforeFirst() ) {
                  Statement stmt1 = conn.createStatement();
                  System.out.println(keysingle  +"INSERT INTO keywordssingle(keywords) VALUES ('"+ keysingle +"')");

                  stmt1.executeUpdate("INSERT INTO keywordssingle(keywords) VALUES ('"+ keysingle +"');");
                  stmt1.close();
                  Statement stmt2 = conn.createStatement();
                  ResultSet rset1 = stmt2.executeQuery("SELECT kID from keywordssingle WHERE keywords='"+ keysingle +"';");
                 System.out.print("SELECT kID from keywordssingle WHERE keywords='"+ keysingle +"';");

                 while(rset1.next()){
                  kid = rset1.getString(1);

                 System.out.print("keysingle\n");
                  System.out.println(rset0.getString(1));
                System.out.print(System.lineSeparator());


                  System.out.println(kid);
                  }
                  rset1.close();
                  stmt2.close();

        	  }
                    	 else{
            	
            	           while(rset0.next()){
            System.out.println("I am here");
            System.out.println("rset0.getString(1)");
                     kid = rset0.getString(1);

                             System.out.println("<br/><br/><b>");

             //        rset0.close();
}}
                          Statement stmt7 = conn.createStatement();

                          String cmd= "INSERT INTO windex VALUES ('"+kid+"', '"+urlID+"', '"+map.get(keysingle)+"' );";

                          System.out.println(cmd);
                          stmt7.executeUpdate(cmd);
                          stmt7.close();


            
                      
            	 

    //      }
      //    rset4.close();
        // }



  //}      catch(SQLException e){
    //     e.printStackTrace();
     // }






//for loop of keyword




}
        System.out.println("Connected");

        }
      catch(SQLException e){
         e.printStackTrace();
      }







                } catch (IOException e) {
                    e.printStackTrace();
                } catch (InterruptedException e) {
                    e.printStackTrace();
                }
              }


















  }

  }
