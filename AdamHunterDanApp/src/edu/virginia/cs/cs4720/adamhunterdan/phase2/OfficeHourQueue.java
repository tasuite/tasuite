package edu.virginia.cs.cs4720.adamhunterdan.phase2;

import java.io.BufferedReader;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.util.ArrayList;
import java.util.concurrent.ExecutionException;

import org.apache.http.HttpEntity;
import org.apache.http.HttpResponse;
import org.apache.http.client.HttpClient;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.impl.client.DefaultHttpClient;

import com.google.gson.Gson;
import com.google.gson.JsonArray;
import com.google.gson.JsonElement;
import com.google.gson.JsonParser;

import twitter4j.Twitter;
import twitter4j.TwitterException;
import twitter4j.TwitterFactory;
import twitter4j.auth.RequestToken;
import twitter4j.conf.ConfigurationBuilder;
import android.app.Activity;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.v4.app.NavUtils;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.ListView;
import android.widget.Toast;

public class OfficeHourQueue extends Activity {

	public void tweetStart(View view) throws InterruptedException,
			ExecutionException {
		Toast.makeText(this, new StartOOTask().execute().get(),
				Toast.LENGTH_LONG).show();
	}

	private class StartOOTask extends AsyncTask<String, Integer, String> {

		@Override
		protected String doInBackground(String... params) {
			try {
				ConfigurationBuilder cb = new ConfigurationBuilder();
				cb.setDebugEnabled(true)
						.setOAuthConsumerKey("qrSztMk5NpVPuuTw0i2aDw")
						.setOAuthConsumerSecret(
								"2khlu4Hj7gzeJXMMkzLLKBtsUb9Q0WnBpjqSF22Mk")
						.setOAuthAccessToken(
								"961843099-fiHUieMe8DrdtyTjqL3HPTkfTw64rNuoOvgC8994")
						.setOAuthAccessTokenSecret(
								"p5QkXa0jkkfsrLJoSjCx9MZeFVjiJ8QczkHdQkJwlE");
				// .setUser("tasuite").setPassword("fall2012");
				TwitterFactory tf = new TwitterFactory(cb.build());
				Twitter twitter = tf.getInstance();
				try {
					// get request token.
					// this will throw IllegalStateException if access token is
					// already available
					RequestToken requestToken = twitter.getOAuthRequestToken();

					requestToken.getToken();
					requestToken.getTokenSecret();

				} catch (IllegalStateException ie) {
					// access token is already available, or consumer key/secret
					// is
					// not set.
					if (!twitter.getAuthorization().isEnabled()) {
						System.out
								.println("OAuth consumer key/secret is not set.");
						System.exit(-1);
					}
				}
				twitter4j.Status status = twitter
						.updateStatus("Office hours are now open!");
				return "Tweet sent successfully!";
			} catch (TwitterException te) {
				te.printStackTrace();

				return "Oops. There was an error.  Please try again.";
			}

		}

	}

	public void tweetEnd(View view) throws InterruptedException,
			ExecutionException {
		Toast.makeText(this, new EndOOTask().execute().get(), Toast.LENGTH_LONG)
				.show();
	}

	private class EndOOTask extends AsyncTask<String, Integer, String> {

		@Override
		protected String doInBackground(String... arg0) {
			try {
				ConfigurationBuilder cb = new ConfigurationBuilder();
				cb.setDebugEnabled(true)
						.setOAuthConsumerKey("qrSztMk5NpVPuuTw0i2aDw")
						.setOAuthConsumerSecret(
								"2khlu4Hj7gzeJXMMkzLLKBtsUb9Q0WnBpjqSF22Mk")
						.setOAuthAccessToken(
								"961843099-fiHUieMe8DrdtyTjqL3HPTkfTw64rNuoOvgC8994")
						.setOAuthAccessTokenSecret(
								"p5QkXa0jkkfsrLJoSjCx9MZeFVjiJ8QczkHdQkJwlE");
				// .setUser("tasuite").setPassword("fall2012");
				TwitterFactory tf = new TwitterFactory(cb.build());
				Twitter twitter = tf.getInstance();
				try {
					// get request token.
					// this will throw IllegalStateException if access token is
					// already available
					RequestToken requestToken = twitter.getOAuthRequestToken();

					requestToken.getToken();
					requestToken.getTokenSecret();

				} catch (IllegalStateException ie) {
					// access token is already available, or consumer key/secret
					// is
					// not set.
					if (!twitter.getAuthorization().isEnabled()) {
						System.out
								.println("OAuth consumer key/secret is not set.");
						System.exit(-1);
					}
				}
				twitter4j.Status status = twitter
						.updateStatus("Office hours are now closed!");
				return "Tweet sent successfully!";
			} catch (TwitterException te) {

				return "Oops.  There was an error.  Please try again.";
			}

		}

	}

	ListView queueList;
	String webserviceURL = "https://plato.cs.virginia.edu/~hwc2d/queuejson.php";
	ArrayList<QueueInstance> values;
	ArrayAdapter<QueueInstance> adapter;

	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.setTheme(android.R.style.Theme_Black);
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_office_hour_queue);
		Intent intent = getIntent();
		queueList = (ListView) findViewById(R.id.officehourqueue);
		values = new ArrayList<QueueInstance>();

		adapter = new ArrayAdapter<QueueInstance>(this,
				android.R.layout.simple_list_item_1, android.R.id.text1, values);

		queueList.setAdapter(adapter);

		new GetQueueTask().execute(webserviceURL);
	}

	@Override
	public boolean onCreateOptionsMenu(Menu menu) {
		getMenuInflater().inflate(R.menu.activity_office_hour_queue, menu);
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

	private class GetQueueTask extends AsyncTask<String, Integer, String> {
		@Override
		protected void onPreExecute() {
		}

		@Override
		protected String doInBackground(String... params) {
			String url = params[0];

			ArrayList<QueueInstance> lcs = new ArrayList<QueueInstance>();

			try {
				String webJSON = getJSONfromURL(url);
				Gson gson = new Gson();

				JsonParser parser = new JsonParser();

				JsonArray Jarray = parser.parse(webJSON).getAsJsonArray();
				for (JsonElement obj : Jarray) {
					QueueInstance s = gson.fromJson(obj, QueueInstance.class);
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
