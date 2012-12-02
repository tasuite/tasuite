package edu.virginia.cs.cs4720.adamhunterdan.phase2;

import android.net.Uri;
import android.os.Bundle;
import android.app.Activity;
import android.content.Intent;
import android.view.Menu;
import android.webkit.WebSettings;
import android.webkit.WebView;
import android.webkit.WebViewClient;
import android.widget.ImageView;

import com.google.api.client.http.HttpTransport;
import com.google.api.client.http.javanet.NetHttpTransport;
import com.google.api.client.json.jackson.JacksonFactory;
//import com.google.api.services.calendar.Calendar;
import com.google.api.services.calendar.model.*;
import java.net.URL;

public class Calendar extends Activity {

	@Override
	public void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_calendar);
		/*
		 * CalendarService myService = new
		 * CalendarService("exampleCo-exampleApp-1");
		 * myService.setUserCredentials("jo@gmail.com", "mypassword");
		 * 
		 * // Send the request and print the response URL feedUrl = new
		 * URL("https://www.google.com/calendar/feeds/default/owncalendars/full"
		 * ); CalendarFeed resultFeed = myService.getFeed(feedUrl,
		 * CalendarFeed.class); System.out.println("Calendars you own:");
		 * System.out.println(); for (int i = 0;
		 * i<resultFeed.getEntries().size(); i++) { CalendarEntry entry =
		 * resultFeed.getEntries().get(i); System.out.println("\t" +
		 * entry.getTitle().getPlainText()); }
		 */
		WebView w = (WebView) findViewById(R.id.webCalendar);
		WebSettings webSettings = w.getSettings();
		webSettings.setJavaScriptEnabled(true);
		w.setWebViewClient(new WebViewClient());
		w.loadUrl("https://www.google.com/calendar/feeds/virginia.edu_enqsqm0btkr8pmqt4pa5d8u6u0%40group.calendar.google.com/public/full");
	}

	@Override
	public boolean onCreateOptionsMenu(Menu menu) {
		getMenuInflater().inflate(R.menu.activity_calendar, menu);
		return true;
	}

	private class MyWebViewClient extends WebViewClient {
		@Override
		public boolean shouldOverrideUrlLoading(WebView view, String url) {
			Intent intent = new Intent(Intent.ACTION_VIEW, Uri.parse(url));
			startActivity(intent);
			return true;
		}
	}
}
