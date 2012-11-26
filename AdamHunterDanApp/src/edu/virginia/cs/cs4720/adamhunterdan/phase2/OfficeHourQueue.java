package edu.virginia.cs.cs4720.adamhunterdan.phase2;

import java.util.concurrent.ExecutionException;

import twitter4j.Twitter;
import twitter4j.TwitterException;
import twitter4j.TwitterFactory;
import twitter4j.auth.RequestToken;
import twitter4j.conf.ConfigurationBuilder;
import android.app.Activity;
import android.os.AsyncTask;
import android.os.Bundle;
import android.view.Menu;
import android.view.View;
import android.widget.Toast;

public class OfficeHourQueue extends Activity {

	public void tweetStart(View view) throws InterruptedException, ExecutionException{
		Toast.makeText(this, new StartOOTask().execute().get(), Toast.LENGTH_LONG).show();
	}
	
	private class StartOOTask extends AsyncTask<String, Integer, String>{

		@Override
		protected String doInBackground(String... params) {
			try {
				ConfigurationBuilder cb = new ConfigurationBuilder();
				cb.setDebugEnabled(true)
				  .setOAuthConsumerKey("qrSztMk5NpVPuuTw0i2aDw")
				  .setOAuthConsumerSecret("2khlu4Hj7gzeJXMMkzLLKBtsUb9Q0WnBpjqSF22Mk")
				  .setOAuthAccessToken("961843099-fiHUieMe8DrdtyTjqL3HPTkfTw64rNuoOvgC8994")
				  .setOAuthAccessTokenSecret("p5QkXa0jkkfsrLJoSjCx9MZeFVjiJ8QczkHdQkJwlE");
//				.setUser("tasuite").setPassword("fall2012");
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
					// access token is already available, or consumer key/secret is
					// not set.
					if (!twitter.getAuthorization().isEnabled()) {
						System.out.println("OAuth consumer key/secret is not set.");
						System.exit(-1);
					}
				}
				twitter4j.Status status = twitter.updateStatus("Office hours are now open!");
				return "Tweet sent successfully!";
			} catch (TwitterException te) {
				te.printStackTrace();
				
				return "Oops. There was an error.  Please try again.";
			}

		}
		
	}
	
	public void tweetEnd(View view) throws InterruptedException, ExecutionException{
		Toast.makeText(this, new EndOOTask().execute().get(), Toast.LENGTH_LONG).show();
	}
	
	private class EndOOTask extends AsyncTask<String, Integer, String> {

		@Override
		protected String doInBackground(String... arg0) {
			try {
				ConfigurationBuilder cb = new ConfigurationBuilder();
				cb.setDebugEnabled(true)
				  .setOAuthConsumerKey("qrSztMk5NpVPuuTw0i2aDw")
				  .setOAuthConsumerSecret("2khlu4Hj7gzeJXMMkzLLKBtsUb9Q0WnBpjqSF22Mk")
				  .setOAuthAccessToken("961843099-fiHUieMe8DrdtyTjqL3HPTkfTw64rNuoOvgC8994")
				  .setOAuthAccessTokenSecret("p5QkXa0jkkfsrLJoSjCx9MZeFVjiJ8QczkHdQkJwlE");
//				.setUser("tasuite").setPassword("fall2012");
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
					// access token is already available, or consumer key/secret is
					// not set.
					if (!twitter.getAuthorization().isEnabled()) {
						System.out.println("OAuth consumer key/secret is not set.");
						System.exit(-1);
					}
				}
				twitter4j.Status status = twitter.updateStatus("Office hours are now closed!");
				return "Tweet sent successfully!";
			} catch (TwitterException te) {
				
				
				return "Oops.  There was an error.  Please try again.";
			}
			
		}
		
	}
	
    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_office_hour_queue);
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        getMenuInflater().inflate(R.menu.activity_office_hour_queue, menu);
        return true;
    }
}
