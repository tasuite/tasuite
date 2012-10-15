package edu.virginia.cs.cs4720.adamhunterdan.phase2;

import android.app.Activity;
import android.content.Intent;
import android.os.Bundle;
import android.widget.TextView;

public class SearchResultActivity extends Activity {

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_search_result);
        
        Intent intent = getIntent();
        String message = intent.getStringExtra(SearchFormActivity.EXTRA_MESSAGE);
        
        TextView textView = new TextView(this);
        textView.setTextSize(40);
        textView.setText(message);
        
        setContentView(textView);
    }

}
