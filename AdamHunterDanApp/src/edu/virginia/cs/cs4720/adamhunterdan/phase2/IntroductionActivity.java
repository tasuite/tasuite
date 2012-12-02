package edu.virginia.cs.cs4720.adamhunterdan.phase2;

import java.util.ArrayList;

import android.os.Bundle;
import android.os.Handler;
import android.app.Activity;
import android.content.Intent;
import android.view.Menu;
import android.widget.EditText;

public class IntroductionActivity extends Activity {
	private static ArrayList<Activity> activities = new ArrayList<Activity>();

	public class WaitHandler extends Handler {
		public IntroductionActivity intro;

		public WaitHandler(IntroductionActivity act) {
			intro = act;
		}
	}

	public class WaitRunnable implements Runnable {
		public IntroductionActivity intro;

		public WaitRunnable(IntroductionActivity act) {
			intro = act;
		}

		public void run() {
			Intent intent = new Intent(intro, HorizontalMain.class);
			startActivity(intent);
		}
	}

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_introduction);
		WaitHandler w = new WaitHandler(this);
		WaitRunnable wR = new WaitRunnable(this);
		w.postDelayed(wR, 4000);

	}
	@Override
	protected void onResume() {
		super.onResume();
		setContentView(R.layout.activity_introduction);
		WaitHandler w = new WaitHandler(this);
		WaitRunnable wR = new WaitRunnable(this);
		w.postDelayed(wR, 4000);
	}

	@Override
	public boolean onCreateOptionsMenu(Menu menu) {
		// Inflate the menu; this adds items to the action bar if it is present.
		getMenuInflater().inflate(R.menu.activity_introduction, menu);
		return true;
	}

	@Override
	public void onDestroy() {
		super.onDestroy();
		activities.remove(this);
	}

	public static void finishAll() {
		for (Activity activity : activities)
			activity.finish();
	}
}
