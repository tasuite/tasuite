package edu.virginia.cs.cs4720.adamhunterdan.phase2;

import android.os.Bundle;
import android.app.Activity;
import android.view.Menu;

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
       /*CalendarService myService = new CalendarService("exampleCo-exampleApp-1");
        myService.setUserCredentials("jo@gmail.com", "mypassword");

        // Send the request and print the response
        URL feedUrl = new URL("https://www.google.com/calendar/feeds/default/owncalendars/full");
        CalendarFeed resultFeed = myService.getFeed(feedUrl, CalendarFeed.class);
        System.out.println("Calendars you own:");
        System.out.println();
        for (int i = 0; i<resultFeed.getEntries().size(); i++) {
          CalendarEntry entry = resultFeed.getEntries().get(i);
          System.out.println("\t" + entry.getTitle().getPlainText());
        }*/
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        getMenuInflater().inflate(R.menu.activity_calendar, menu);
        return true;
    }
}
