Hello,

From the task i faced few issues to create Url links and to create load more button. Eventhough i went through lot of approaches 
i couldn't get the results. I would like to show you some of the approaches that i used to achieve results.

As per my understanding i first tryed to give Url links and load more button in migration version .php file but i realized that correct approach is to 
write required code in twig file.


In Index.html.twing tried to change as follows:

<thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Releasedate</th>
                <th>Length</th>
                <th><a href="http://example.com/">Genres</a></th>
                <th>Actions</th>
            </tr>
        </thead>

(but didn't work)
in some other lines modified to:

<td><a href="{{path('http://example.com/',{'Name': library.name}) }}">{{ library.name }}</a></td>
(may be instead of path is Url is right way?)


in show.html.twing modified to this but didn't work

<tr>
                <th>Genres</th>
                <td><a href="{{path('http://example.com/',{'genres': library.genres}) }}">{{ library.genres }}</a></td>
</tr>


In edit.html.twig file tried to modify in this way. Means buttons could be created in this way in the {%block body} function

{{ form_start(loadmore_form) }}
                <input type="submit" value="LoadMore">
            {{ form_end(loadmore_form) }}



I approached by crating new twig file to create load more button. 

And also i created seperate html files for every genres and gave the related book names with the example link which i uploaded in the 'my_hometask' folder.
I tried to link these html files to migrations version .php file but didn't work.

All my approches couldn't give results for required task. But i felt very interesting in doing task and got to learn more interesting things.
Thank You :)