package edu.virginia.cs.cs4720.adamhunterdan.phase2;

import android.os.Bundle;
import android.app.Activity;
import android.view.Menu;

public class Calendar extends Activity {

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_calendar);
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        getMenuInflater().inflate(R.menu.activity_calendar, menu);
        return true;
    }
}
