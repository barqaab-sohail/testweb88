<h1>{{ $title }}</h1>
<table class="table table-bordered" id="laravel_crud">
 <thead>
    <tr>
       <th>Id</th>
       <th>Title</th>
       <th>Description</th>
       <th>Created at</th>
        
    </tr>
 </thead>
 <tbody>
    <tr>
       <td>1</td>
       <td>this is for test</td>
       <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
       tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
       quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
       consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
       cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
       proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</td>
       <td>{{ date('d m Y') }}</td>
         
    </tr>
 </tbody>
</table>