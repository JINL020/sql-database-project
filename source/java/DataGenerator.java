package recipePlatform;

import java.io.BufferedReader;
import java.io.FileReader;
import java.io.IOException;
import java.util.AbstractMap;
import java.util.HashMap;
import java.util.HashSet;
import java.util.Map;
import java.util.Random;
import java.util.Set;

public class DataGenerator {
	public static Set<String> nicknames = new HashSet<String>();

	public static Map<Integer,Set<Integer>> friends = new HashMap<>();
	
	public static Set<String> ingredientName = new HashSet<>();
	
	public static Map<Integer,Set<Integer>> needs = new HashMap<>();
	
	public static Set<String> contains = new HashSet<>();
	
	public static String[] recipeTitel = {
			"Red Velvet Cake1","Schokoladenkuchen",
			"Haselnusskuchen", "Cheesecake", "Bulgogi",
			"Dumplings", "Kimchi","jjajangmyeon",
			"Bulgogi", "lemonade","pumpkin spice latte",
			"Strawberry Limeade","Citrus peach cooler"
	};
	
	public static String[] recipeInstruction = {
			"mix it up",
			"just do it",
			"cook it",
			"chop it"
	};
	
	public static String[] category = {
			"asian", "italien", "korean", "american",
			"indian", "japanese", "austrian"
	};
	
	public static String[] HORorCOLD = {"HOT","COLD"};
	
	
	public static String[]comments = {
			"Exquisite!",
			"Would give 10 out of 10",
			"mehhhh",
			"Delicious!",
			"Would not do again",
			"have tasted better",
			"Could be better"
	};
	
	DataGenerator(){
		String line = "";
	    try {
	    	BufferedReader br = new BufferedReader(new FileReader("users.txt"));
		    while((line = br.readLine()) != null) {
		    	String[] value = line.split(",");
		    	nicknames.add(value[0]);
		    }
		    br.close();
		    br = new BufferedReader(new FileReader("ingredients.txt"));
		    while((line = br.readLine()) != null) {
		    	String[] value = line.split(",");
		    	ingredientName.add(value[0]);
		    }
		    br.close();
		 }catch(IOException e) {
	    	  e.printStackTrace();
	      }
	}
	
	public static String randomPasword() {
		String characters = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz123456789";
  		String randomString = "";
  		int length = 6;
  		
  		Random rand = new Random();
  		char[]text = new char[length];
  		
  		for(int i = 0; i < length; i++) {
  			text[i] = characters.charAt(rand.nextInt(characters.length()));
  		}
  		for(int i = 0; i < text.length; i++) {
  			randomString += text[i];
  		}
  		return randomString;
  	}
	
	public static Map.Entry<Integer, Integer> randomFriends() {
		Random rand = new Random();
		int f1 = (rand.nextInt(nicknames.size())+1);
		int f2 = (rand.nextInt(nicknames.size())+1);
		friends.putIfAbsent(f1, new HashSet<>());
		while(f1 == f2 || friends.get(f1).contains(f2)) {
			f2 = rand.nextInt(nicknames.size())+1;
		}
		friends.get(f1).add(f2);
		Map.Entry<Integer,Integer> entry = new AbstractMap.SimpleEntry<Integer, Integer>(f1, f2);
		return entry;
	}
	
	public static Map.Entry<Integer, Integer> randomContains() {
		Random rand = new Random();
		String f1 = Integer.toString(rand.nextInt(250)+1);
		String f2 = Integer.toString(rand.nextInt(500)+1);
		while(DataGenerator.contains.contains(f1.concat(f2))) {
			f1 = Integer.toString(rand.nextInt(250)+1);
			f2 = Integer.toString(rand.nextInt(500)+1);
		}
		contains.add(f1.concat(f2));
		Map.Entry<Integer,Integer> entry = new AbstractMap.SimpleEntry<Integer, Integer>(Integer.parseInt(f1), Integer.parseInt(f2));
		return entry;
	}
	
	public static String randomAllergenCode() {
		String characters = "ABCDEFGHLMNOPR";
  		String randomString = "";
  		int length = 1;
  		
  		Random rand = new Random();
  		char[]text = new char[length];
  		
  		for(int i = 0; i < length; i++) {
  			text[i] = characters.charAt(rand.nextInt(characters.length()));
  		}
  		for(int i = 0; i < text.length; i++) {
  			randomString += text[i];
  		}
  		return randomString;
  	}
	
	public static int randomUser() {
  		Random rand = new Random();
  		return (rand.nextInt(nicknames.size())+1);
  	}
	
	public static int randomRecipeID() {
  		Random rand = new Random();
  		return (rand.nextInt(500)+1);
  	}
	
	public static int RandomCompilationID() {
  		Random rand = new Random();
  		return (rand.nextInt(250)+1);
  	}
	
	public static String randomRecipeTitel() {
  		Random rand = new Random();
  		return recipeTitel[rand.nextInt(recipeTitel.length)];
  	}
	
	public static String randomRecipeInstruction() {
  		Random rand = new Random();
  		return recipeInstruction[rand.nextInt(recipeInstruction.length)];
  	}	
	
	public static String randomCategory() {
  		Random rand = new Random();
  		return category[rand.nextInt(category.length)];
  	}	
	public static String randomHOTorCOLD() {
  		Random rand = new Random();
  		return HORorCOLD[rand.nextInt(2)];
  	}
	
	public static String randomComment() {
  		Random rand = new Random();
  		return comments[rand.nextInt(comments.length)];
  	}
	
	
	public static Map.Entry<Integer, Integer> randomNeeds() {
		Random rand = new Random();
		int f1 = (rand.nextInt(500-1)+1);
		int f2 = (rand.nextInt(ingredientName.size())+1);
		needs.putIfAbsent(f1, new HashSet<>());
		while(f1 == f2 || needs.get(f1).contains(f2)) {
			f2 = (rand.nextInt(ingredientName.size())+1);
		}
		needs.get(f1).add(f2);
		Map.Entry<Integer,Integer> entry = new AbstractMap.SimpleEntry<Integer, Integer>(f1, f2);
		return entry;
	}

}
