package recipePlatform;

import java.sql.*;
import java.util.Map;
import java.util.Random;
public class recipePlatformGenerator {
	
	public static void main(String args[]) {
		try {
			// Loads the class "oracle.jdbc.driver.OracleDriver" into the memory
			Class.forName("oracle.jdbc.driver.OracleDriver");
			
			// Connection details
			String database = "jdbc:oracle:thin:@oracle-lab.cs.univie.ac.at:1521:lab";
			String user = "a11913405";
			String pass = "dbs20";
	
			// Establish a connection to the database
			Connection con = DriverManager.getConnection(database, user, pass);
			Statement stmt = con.createStatement();
	      
			//DataGenerator Object
			new DataGenerator();
			Random rand = new Random();
	      
			// Insert dataset into the table
			try {
				String insertSql = "INSERT INTO users (nickname, password, email) VALUES (?, ?, ?)";
				PreparedStatement prepStmt = con.prepareStatement(insertSql);
				int batchCount = 0;
				for(String elem : DataGenerator.nicknames) {
			        prepStmt.setString(1,elem);
			        prepStmt.setString(2,DataGenerator.randomPasword());
			        prepStmt.setString(3,elem + "@gmail.com");
			        prepStmt.addBatch();
			        batchCount++;
			        if (batchCount % 100 == 0 || batchCount == DataGenerator.nicknames.size()) {
						prepStmt.executeBatch();
	                }
				}
	    
		        insertSql = "INSERT INTO friend (user1, user2) VALUES (?, ?)";
		        prepStmt = con.prepareStatement(insertSql);
		        batchCount = 0;
		        int friendsLoop = 3000;
		        for(int i=0; i<friendsLoop; i++) {
		        	Map.Entry<Integer,Integer> entry = DataGenerator.randomFriends();
			        prepStmt.setInt(1,entry.getKey());
			        prepStmt.setInt(2,entry.getValue());
			        prepStmt.addBatch();
			        batchCount++;
			        if (batchCount % 100 == 0 || batchCount == friendsLoop) {
						prepStmt.executeBatch();
	                }
		        }
	        
		        insertSql = "INSERT INTO recipe (title, prepTime, description, writer) VALUES (?, ?, ?, ?)";
		        prepStmt = con.prepareStatement(insertSql);
		        batchCount = 0;
		        int recipeLoop = 500;
		        for(int i=0;i<recipeLoop;i++) {
			        prepStmt.setString(1,DataGenerator.randomRecipeTitel());
			        prepStmt.setInt(2,rand.nextInt(300-10)+10);
			        prepStmt.setString(3,DataGenerator.randomRecipeInstruction());
			        prepStmt.setInt(4,DataGenerator.randomUser());
			        prepStmt.addBatch();
			        batchCount++;
			        if (batchCount % 100 == 0 || batchCount == recipeLoop) {
						prepStmt.executeBatch();
	                }
			    }	
	        
		        insertSql = "INSERT INTO dish (kcal, category, recipeID) VALUES (?, ?, ?)";
		        prepStmt = con.prepareStatement(insertSql);
		        batchCount = 0;
		        int dishLoop = (recipeLoop/2);
		        for(int i=0;i<250;i++) {
			        prepStmt.setInt(1,rand.nextInt(3000-1)+1);
			        prepStmt.setString(2,DataGenerator.randomCategory());
			        prepStmt.setInt(3,i+1);
			        prepStmt.addBatch();
			        batchCount++;
			        if (batchCount % 100 == 0 || batchCount == dishLoop) {
						prepStmt.executeBatch();
	                }
			    }
	        
		        insertSql = "INSERT INTO beverage (alcoholPercentage, HOTorCOLD, recipeID) VALUES (?, ?, ?)";
		        prepStmt = con.prepareStatement(insertSql);
		        batchCount = 0;
		        int beverageLoop = (recipeLoop/2);
		        for(int i=250; i<(beverageLoop+ dishLoop); i++) {
			        prepStmt.setInt(1,rand.nextInt(40));
			        prepStmt.setString(2,DataGenerator.randomHOTorCOLD());
			        prepStmt.setInt(3,i+1);
			        prepStmt.addBatch();
			        batchCount++;
			        if (batchCount % 100 == 0 || batchCount == beverageLoop) {
						prepStmt.executeBatch();
	                }
		        }
		       
		        insertSql = "INSERT INTO ingredient (ingredientName, allergenCode) VALUES (?, ?)";
		        prepStmt = con.prepareStatement(insertSql);
		        batchCount = 0;
		        for(String elem : DataGenerator.ingredientName) {
			        prepStmt.setString(1,elem);
			        prepStmt.setString(2,DataGenerator.randomAllergenCode());
			        prepStmt.addBatch();
			        batchCount++;
			        if (batchCount % 100 == 0 || batchCount ==  DataGenerator.ingredientName.size()) {
						prepStmt.executeBatch();
			        }
		        }
		        
		        insertSql = "INSERT INTO needs (recipe, ingredient) VALUES (?, ?)";
		        prepStmt = con.prepareStatement(insertSql);
		        batchCount = 0;
		        int needsLoop = 4000;
		        for(int i = 0; i < needsLoop; i++) {
		        	Map.Entry<Integer, Integer> entry = DataGenerator.randomNeeds();
			        prepStmt.setInt(1,entry.getKey());
			        prepStmt.setInt(2,entry.getValue());
			        prepStmt.addBatch();
			        batchCount++;
			        if (batchCount % 100 == 0 || batchCount == needsLoop) {
						prepStmt.executeBatch();
			        }
		        }
		        
		        insertSql = "INSERT INTO comments (rating, text, recipe) VALUES (?, ?, ?)";
		        prepStmt = con.prepareStatement(insertSql);
		        batchCount = 0;
		        int commentsLoop = 600;
		        for(int i = 0; i < commentsLoop; i++) {
			        prepStmt.setInt(1,rand.nextInt(5)+1);
			        prepStmt.setString(2,DataGenerator.randomComment());
			        prepStmt.setInt(3,DataGenerator.randomRecipeID());
			        prepStmt.addBatch();
			        batchCount++;
			        if (batchCount % 100 == 0 || batchCount ==  commentsLoop) {
						prepStmt.executeBatch();
			        }
		        }
		      
		        insertSql = "INSERT INTO compilation (title, description, userID) VALUES (?, ?, ?)";
		        prepStmt = con.prepareStatement(insertSql);
		        batchCount = 0;
		        int compilationLoop = 250;
		        for(int i = 0; i < compilationLoop; i++) {
			        prepStmt.setString(1, "Compilation Nr" + (i+1));
			        prepStmt.setString(2,"This is compilation Nr" + (i+1));
			        prepStmt.setInt(3, DataGenerator.randomUser());
			        prepStmt.addBatch();
			        batchCount++;
			        if (batchCount % 100 == 0 || batchCount ==  compilationLoop) {
						prepStmt.executeBatch();
			        }
		        }
		        
		        insertSql = "INSERT INTO contains (compilation, recipe) VALUES (?, ?)";
		        prepStmt = con.prepareStatement(insertSql);
		        batchCount = 0;
		        int containsLoop = 800;
		        for(int i = 0; i < containsLoop; i++) {
		        	Map.Entry<Integer, Integer> entry = DataGenerator.randomContains();
			        prepStmt.setInt(1,entry.getKey());
			        prepStmt.setInt(2,entry.getValue());
			        prepStmt.addBatch();
			        batchCount++;
			        if (batchCount % 100 == 0 || batchCount ==  containsLoop) {
						prepStmt.executeBatch();
			        }
		        }
		        
			} catch (Exception e) {
	        System.err.println("Error while executing INSERT INTO statement: " + e.getMessage());
			}
			
			// Check number of datasets in tables
			String[] countDataset = {
					"users",
					"friend",
					"recipe",
					"dish",
					"beverage",
		    		"ingredient",
		    		"needs",
		    		"comments",
		    		"compilation",
		    		"contains"
		    };

			for(String elem : countDataset) {
				ResultSet rs = stmt.executeQuery("SELECT COUNT(*) FROM " + elem);
				if (rs.next()) {
					int count = rs.getInt(1);
					System.out.println("Number of datasets " + elem +": " + count);
				}
				rs.close();
			}
			
			// Clean up connections
		    stmt.close();
		    con.close();
		} catch(Exception e) {
		      System.err.println(e.getMessage());
		  }
		
	}
}