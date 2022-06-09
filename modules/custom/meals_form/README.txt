MEALS FORM MODULE FOR FIONTA CODE ASSESSMENT
---------------------------------------------

REQUIREMENTS
------------


Drupal Development Exercise


A catering company wishes to expedite the process of having individuals specify their mealchoice before an event. 
They plan to send out an email to all event participants with a linkto a form where people can make their meal choice.
Please create a module for the form. It should fulfill the following requirements.

1. As a user of the site, I want to enter my name and email address to identify myself

2. As a user of the site, I want to select the type of meal that I want at the event(Options: Meat, Fish, Vegetarian)

3. As a user of the site, I want to specify dietaryrestrictions (Gluten-Free, Dairy-Free)

4. As a user of the site, I want to be able to add special instructions or other dietaryrestrictions

5. As an administrator of the site, I want to see a summary page that shows the total ofeach type of meal ordered, so that I can order ingredients

6. As an administrator of the site, I want to be emailed whenever an order is madewith special instructions, so that I can give that order special attention


Complete this task in Drupal 9. 

Part of the goal is to understand how you interpretrequirements and solve problems with Drupal, 
so there are many ways to satisfy theserequirements. 

You may ask any clarifying questions.

The code should be received as a module that can be enabled on an otherwise empty site.

The use of contrib modules is allowed via composer, 
but the Fionta reviewer shouldn't need to do anything besides run composer and turn the custom module on.



SOLUTION EXPLAINED
------------------

1. Installed webform module and add it as a dependency in order to use 
   an already built solution that does 100% of the work needed for the form submissions and storage plus url aliasing.

2. Created the webform with all the required settings and exported the config yml file 
   in order to place it on the config/install directory of the new module, 
   this will create the form whenever the module is install, satisfying the requirements
   for the Fionta reviewer.

3. Used hook_webform_submission_presave to check if the submission contains special instructions
   in order to send an email to the Site admin, used hook_email to finish the email sending process.

4. Used hook_theme to create the theme mapping for meals summary page. 
   Created the route for the meals summary page on the module routing yml file along with
   the definition of the controller and the function that will provide the markup for the page.
   This route will be only for admin roles.

5. Added the logic for getting all the form submissions for the meals form and built the meals 
   variable that will be sent to the template in order to render the summary for meal types' amounts.

6. Added the template for the meals summary page that renders the required summary.


IMPORTANT LINKS
---------------
Meals preference form: [$root]/webform/meals_form (For anonymous users)
Meals summary page: [$root]/meals-summary (For Admins only)