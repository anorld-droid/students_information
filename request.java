import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import java.nio.charset.MalformedInputException;
import java.util.Random;
import java.util.Timer;
import java.util.TimerTask;
//Program to generate a request after some random time
class request {
    private static HttpURLConnection connect;

    public static void main(String[] args) {
//create a random variable
        Random random = new Random();
        int random_time = random.nextInt(5000)+1;
        Timer timer = new Timer();
        TimerTask task = new TimerTask() {
            @Override
            public void run() {
                BufferedReader reader;
                String line;
                StringBuffer response_content = new StringBuffer();

                try {
                    URL url = new URL("https://jsonplaceholder.typicode.com/albums");
                    connect = (HttpURLConnection) url.openConnection();
                    // setup conncetion

                    connect.setRequestMethod("GET");
                    connect.setConnectTimeout(5000);
                    connect.setReadTimeout(5000);

                    int status = connect.getResponseCode();
                    if (status > 299) {
                        reader = new BufferedReader(new InputStreamReader(connect.getErrorStream()));

                        while ((line = reader.readLine()) != null) {
                            response_content.append(line);

                        }
                        reader.close();
                    } else {
                        reader = new BufferedReader(new InputStreamReader(connect.getInputStream()));
                        while ((line = reader.readLine()) != null) {
                            response_content.append(line);
                            System.out.println(response_content);

                        }
                        reader.close();
                    }
                } catch (MalformedURLException e) {
                    e.printStackTrace();
                } catch (IOException e) {
                    e.printStackTrace();
                } finally {
                    connect.disconnect();
                }
            }

        };
        timer.schedule(task, 2000, random_time);

    }
}