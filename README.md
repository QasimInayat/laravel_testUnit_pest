##Logic Testing
<pre>php artisan make:test SlugServiceTest --unit</pre>
<p>
- This command creates a Unit Test. Files inside the Unit folder are used to test only logic and data without involving the database.<br>
- To run these tests, make sure each function either starts with <code>test_</code> or includes the <code>@test</code> annotation.
</p>
<pre>php artisan test --testsuite=Unit</pre>


##Testing With Database, Routes, Middleware and ......
<p>Change the credentials in phpunit.xml (can bee seen on the root)</p>

<pre>php artisan make:test TodoApiTestphp</pre>
<p>
- This command creates a Feature Test. Feature tests cover scenarios with database interactions, routes, middleware, and the full application flow.
</p>
<pre>php artisan test --filter=TodoApiTest</pre>
