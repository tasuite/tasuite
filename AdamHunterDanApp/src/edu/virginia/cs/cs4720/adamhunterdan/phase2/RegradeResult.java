package edu.virginia.cs.cs4720.adamhunterdan.phase2;

import java.io.BufferedReader;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.util.ArrayList;

import org.apache.http.HttpEntity;
import org.apache.http.HttpResponse;
import org.apache.http.client.HttpClient;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.impl.client.DefaultHttpClient;

import android.app.Activity;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.v4.app.NavUtils;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;
import android.widget.ArrayAdapter;
import android.widget.ListView;

import com.google.gson.Gson;
import com.google.gson.JsonArray;
import com.google.gson.JsonElement;
import com.google.gson.JsonParser;

public class RegradeResult extends Activity {
	ListView regradeList;
	String webserviceURL = "http://tasuite.appspot.com/view";
	ArrayList<Regrade> values;
	ArrayAdapter<Regrade> adapter;
	
    @Override
    public void onCreate(Bundle savedInstanceState) {
    	super.setTheme( android.R.style.Theme_Black );
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_search_result_regrade);
        Intent intent = getIntent();
		String message = intent
				.getStringExtra(RegradeSearch.EXTRA_MESSAGE);
		//webserviceURL += message;

		regradeList = (ListView) findViewById(R.id.regradeList);
		values = new ArrayList<Regrade>();

		adapter = new ArrayAdapter<Regrade>(this,
				android.R.layout.simple_list_item_1, android.R.id.text1, values);
		
		regradeList.setAdapter(adapter);
		
		new GetRegradesTask().execute(webserviceURL);
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        getMenuInflater().inflate(R.menu.activity_search_result_regrade, menu);
        return true;
    }

    
    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        switch (item.getItemId()) {
            case android.R.id.home:
                NavUtils.navigateUpFromSameTask(this);
                return true;
        }
        return super.onOptionsItemSelected(item);
    }
    public static String getJSONfromURL(String url) {

		// initialize
		InputStream is = null;
		String result = "";

		// http post
		try {
			HttpClient httpclient = new DefaultHttpClient();
			HttpGet httpget = new HttpGet(url);
			HttpResponse response = httpclient.execute(httpget);
			HttpEntity entity = response.getEntity();
			is = entity.getContent();

		} catch (Exception e) {
			Log.e("Web Service", "Error in http connection " + e.toString());
		}

		// convert response to string
		try {
			BufferedReader reader = new BufferedReader(new InputStreamReader(
					is, "iso-8859-1"), 8);
			StringBuilder sb = new StringBuilder();
			String line = null;
			while ((line = reader.readLine()) != null) {
				sb.append(line + "\n");
			}
			is.close();
			result = sb.toString();
		} catch (Exception e) {
			Log.e("LousList", "Error converting result " + e.toString());
		}

		return result;
	}
    private class GetRegradesTask extends AsyncTask<String, Integer, String> {
		@Override
		protected void onPreExecute() {
		}

		@Override
		protected String doInBackground(String... params) {
			String url = params[0];
			
			ArrayList<Regrade> lcs = new ArrayList<Regrade>();
			
			try{
				String webJSON = getJSONfromURL(url);
				Gson gson = new Gson();
				
				JsonParser parser = new JsonParser();
				
				JsonArray Jarray = parser.parse(webJSON).getAsJsonArray();
				for (JsonElement obj : Jarray) {
					Regrade s = gson.fromJson(obj, Regrade.class);
					lcs.add(s);
				}
			} catch (Exception e) {
				Log.e("Web Service", "JSONPARSE: " + e.toString());
			}
			
			values.clear();
			
			values.addAll(lcs);
			
			return "Done!";
		}

		@Override
		protected void onProgressUpdate(Integer... ints) {
		}

		@Override
		protected void onPostExecute(String result) {
			// Notifies adapter that data has changed, and view must update
			adapter.notifyDataSetChanged();
		}
	}


}
