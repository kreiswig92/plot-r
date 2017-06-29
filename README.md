# plot-r
A task management web application currently in development

PLOT-R INFO

----------------------------------DATABASE--------------------------------------

YOU MUST HAVE A PDOCONNECT SCRIPT NAMED "connectplotr.php" located in the "lib"
directory above the root of the project folder.

Once a data base is built and connected you can run the "build.php" to build
the database.

--------------------------------FILES-------------------------------------------

this application is built in an MVC framework

-->ROOT FILES

    -->index.php

        *index.php is the controller of the application, every page is rendered
        from this page

    -->logout.php

      *logout.php handles logging out for users.

    -->

      *reg_confirm.php was used to redirect the user once register, however
      it's functionality broke once the application was migrated to a MVC
      structure. It is currently unused, but remains in the project so it can
      be modified at a later date.


-->requires

    *Files in the requires directory are used for page renders. head-nav.php,
    and foot.php contain page elements used on every page of the application.

    helpers.php, and render_functions.php, contain functions that are required
    in each page of the application.

-->Modals

    *The files in the modals directory are for processing data from AJAX calls,
    files with underscores contain functions for dealing with data from AJAX calls.

--> scripts

  *The scripts folder contains all javascript files. Most of these files process
  AJAX calls. The exception being sidebar.js which handles the positioning of
  the sidebar on scroll for certain pages.

-->Views

  *The views directory contains all of the HTML/PHP required for rendering
  specific pages in the application. When a page is called buy index.php the
  render_page() functions requires the view necessary for building the page.


-------------------------Dependencies--------------------------------------------

-->jQuery/jquery-ui

    Both jQuery and jQuery-ui are included in the bower_components folder,
    nothing needs to be done to link these.

--> fontawesome

    Fontawesome is used for most of the icons ion the application. It is linked
in the 'head-nav.php' file and should work as expected.



-------------------------Known Issues--------------------------------------------

--> Registration
      currently no registration confirmation is displayed when a new account is
      created. This broke when the project was migrated to a MVC structure.
      By providing registration feedback through a AJAX call as opposed to the
      current implementation of a redirect the issue will be resolved.

-->Log-in
      Logging in works as expected when a correct username an password is
      provided by the user. However, no feedback is displayed when incorrect
      credentials are given. This broke when the project was migrated to a MVC
      structure.

--> Changing Passwords
      Users cannot currently change their passwords. This is an issue with an
      AJAX call that takes place upon form submission. The issue is being
      researched. 
