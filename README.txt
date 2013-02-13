/*
 * This file is part of Data Dashboard Project.
 * 
 * Data Dashboard Project is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * Foobar is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with Foobar.  If not, see <http://www.gnu.org/licenses/>.
 * 
 */
 
Data Dashboard Project is software to display some data nicely

The framework uses Twitter Bootstrap:
http://twitter.github.com/bootstrap/
and 
a php json prettifier by umbrae at gmail dot com
http://www.php.net/manual/en/function.json-encode.php#80339
and
the Exhibit framework
http://www.simile-widgets.org/exhibit3/
(The files that display the exhibit data rely heavily on the public examples)

It relies on specific csv files to show specific data, so a fair amount
of customisation  may be required to get your data to work in this 
software.

However, the routines to turn csv data to json for output in Exhibit files
should be easy to adapt to your needs, as should the csv to php and then
onto graphs routines.

== INSTALL ==
= Copy all the files to a directory on your webserver =

= Add your data =
You will need to put data in the following directories:
exhibit_data - 3 csv files can be turned into 3 corresponding json files using the php scripts
TO DO automate the saving of the data to the corresponding files (maybe password protect the running of the scripts)

processed_data/data - also needs 3 csv files


= Custom config =
Copy example.settings.php to settings.php and edit the available parameters

Javascript links from graphs to Exhibits can be hard wired into index.php google chart code

