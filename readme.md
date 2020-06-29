## It's a map!

It's a map is a simple map site built on Laravel using Mapbox. This is meant as a code test for myself, to see where I'm up to right now. If you like my steez, feel free to gmail me at abrahambrookes@

### The App
Display a map of your favourite places to your friends. Create map markers, upload images and describe each map location in a nifty little digital map.

#### Features
 - Edit your map with a cute little drag n drop interface (using MapboxGL-js)
 - Add map pointers to your map (using Eloquent models)
 - Upload an image for your map pointer (using Filestack)
 
 #### Live version
 If it's up, a live version will be located at [iam.brookesy.dev](https://iam.brookesy.dev/). Feel free to register a dummy account and vandalize it.
 
### Installation
 1. Clone this repo - `git clone https://github.com/AbrahamBrookes/itsamap.git`
 2. Install Composer dependencies - `composer install`
 3. Install Node modules - `npm install`
 4. Copy over .env - `cp .env.example .env`
 5. Create a new mysql database and add the DB details to your newly minted .env
 6. Migrate the db - `php artisan migrate`
 7. Set up your virtualhost. Here's my setup:
 
		<VirtualHost *:443>

			ServerName iam.brookesy.dev
			
			DocumentRoot /var/www/html/iam/public
			<Directory /var/www/html/iam/public>
				Options Indexes FollowSymLinks MultiViews
				AllowOverride All
				Order allow,deny
				allow from all
				Require all granted
			</Directory>

			ServerAdmin webmaster@localhost

			ErrorLog ${APACHE_LOG_DIR}/error.log
			CustomLog ${APACHE_LOG_DIR}/access.log combined

			Include /etc/letsencrypt/options-ssl-apache.conf
			SSLCertificateFile /etc/letsencrypt/live/brookesy.dev-0001/fullchain.pem
			SSLCertificateKeyFile /etc/letsencrypt/live/brookesy.dev-0001/privkey.pem
			
		</VirtualHost>

 8. Ensure your servers Laravel user has access to the storage directory - `sudo chown -R user:group /var/www/html/iam/storage`
 9. You should be good to go!
