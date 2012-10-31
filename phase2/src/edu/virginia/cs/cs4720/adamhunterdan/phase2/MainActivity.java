package edu.virginia.cs.cs4720.adamhunterdan.phase2;

import android.os.Bundle;
import android.app.Activity;
import android.content.Intent;
import android.view.Menu;
import android.view.View;
import android.widget.EditText;

public class MainActivity extends Activity {

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        getMenuInflater().inflate(R.menu.activity_main, menu);
        return true;
    }
    public void go_regrade(View view){
    	Intent intent = new Intent(this, SearchFormRegradeActivity.class);
    	startActivity(intent);
    	
    }
    public void go_student(View view){
    	Intent intent = new Intent(this, SearchFormActivity.class);
    	startActivity(intent);
    	
    }
}
