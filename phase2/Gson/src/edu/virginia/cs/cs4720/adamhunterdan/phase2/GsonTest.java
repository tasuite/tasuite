package edu.virginia.cs.cs4720.adamhunterdan.phase2;

import java.io.BufferedReader;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.util.ArrayList;

import org.apache.http.HttpEntity;
import org.apache.http.HttpResponse;
import org.apache.http.client.HttpClient;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.impl.client.DefaultHttpClient;

import com.google.gson.Gson;
import com.google.gson.JsonArray;
import com.google.gson.JsonElement;
import com.google.gson.JsonParser;


public class GsonTest {
	
	public static ArrayList<Student> values;
	
	public static void main(String[] args) {
		values = new ArrayList<Student>();
		String url = "http://plato.cs.virginia.edu/~atc4cy/tasuite/phase1/rest/student/view/dgm3df";
		
		InputStream is = null;
		String res = "";
		
		try {
			HttpClient hc = new DefaultHttpClient();
			HttpPost hp = new HttpPost(url);
			HttpResponse r = hc.execute(hp);
			HttpEntity e = r.getEntity();
			is = e.getContent();
		} catch(Exception e){
			e.printStackTrace();
		}
		
		try {
			BufferedReader reader = new BufferedReader(new InputStreamReader(is, "iso-8859-1"), 8);
			StringBuilder sb = new StringBuilder();
			String line = null;
			while((line = reader.readLine()) != null) {
				sb.append(line + "\n");
			}
			is.close();
			res = sb.toString();
		} catch (Exception e) {
			e.printStackTrace();
		}
		
		ArrayList<Student> lcs = new ArrayList<Student>();
		String webJSON = res;
		Gson g = new Gson();
		JsonParser jp = new JsonParser();
		JsonArray ja = jp.parse(webJSON).getAsJsonArray();
		
		for(JsonElement obj : ja) {
			Student s = g.fromJson(obj, Student.class);
			System.out.println(obj);
			lcs.add(s);
		}
		
		values.clear();
		values.addAll(lcs);
		
		System.out.println(values.get(0));
		
	}
}
