RaspberryPints (RPints) is a digital upgrade to the conventional chalkboard taplist, created just for the home brewer. Display your current beers on tap with a sleek, digital presentation. Manage your beers, recipes, kegs, and taps with our built-in tracking system.

Docker

I'm making this fork to:

1. Use Docker for MySql Server (5.5 to start)
2. Make it run on PHP 7.x
3. ?

Docker Setup

	shell> docker pull mysql/mysql-server:5.5
	shell> docker run --name=mysql1 -d -p 3306:3306 mysql/mysql-server:5.5
	shell> docker logs mysql1 2>&1 | grep GENERATED
	[Entrypoint] GENERATED ROOT PASSWORD: .@J3BgIMwOB4n4n4sOdAN8UjM0p
	shell> docker exec -it mysql1 mysql -uroot -p
	Enter password:
	mysql> SET PASSWORD FOR 'root'@'localhost' = PASSWORD('AnythingBut123456');
	mysql> quit
	shell> docker exec -it mysql1 mysql -uroot -p
	Enter password:
	mysql> create user 'root'@'%' identified by 'AnythingBut123456';
	mysql> grant all privileges on *.* to 'root'@'%' with grant option;
	mysql> flush privileges;
	
App Install/Setup (local while I'm grocking)

    shell> git clone https://github.com/tiptone/RaspberryPints.git
    shell> cd RaspberryPints/
    shell> php -S 0.0.0.0:8080 -t .
	
Now visit http://localhost:8080/install/index.php.  Get screen shots of install
sections and/or reference [Step 4](https://bernerbits.github.io/ras-pints-without-pi/)
changing Database Server from 'localhost' to '127.0.0.1' (Mac/Docker things). You'll
need to take note of the *Database Username* and *Database Password* in
Step 2 for the privs below. Probably don't need *everything* I'm granting?

	shell> docker exec -it mysql1 mysql -uroot -p
	Enter password:
	mysql> create user 'DatabaseUsername'@'%' identified by 'DatabasePassword';
	mysql> grant all privileges on *.* to 'beers'@'%' with grant option;
	mysql> flush privileges;
	
At this point you can login to the [Admin page](http://localhost:8080/admin/),
though nothing is functional. If you loaded the Sample Data during Install/Setup
you can see it at http://localhost:8080/index.php.

Licensing:

	GNU GENERAL PUBLIC LICENSE
	Version 3, 29 June 2007

	This program is free software: you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation, either version 3 of the License, or
	(at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program.  If not, see <http://www.gnu.org/licenses/>.

Full license text available in 'LICENSE.md'.


Questions? Comments? Want to Contribute?
http://www.homebrewtalk.com/f51/initial-release-raspberrypints-digital-taplist-solution-456809/

Inspired by Kegerface:
http://github.com/kegerface/kegerface
