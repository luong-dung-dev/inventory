# Coding assessment - PHP Version

## Dear Candidate
Welcome to our take-home coding assessment. 
We trust you'll find this assessment both challenging and rewarding, and we look forward to the opportunity to discuss your accomplishments further in the next stage.

## Project features
We have a system in place that updates our inventory for us.

- All items have a `SellIn` value which denotes the number of days we have to sell the items
- All items have a `Quality` value which denotes how valuable the item is
- At the end of each day our system lowers both values for every item

Pretty simple, right? Well this is where it gets interesting:

- Once the sell by date has passed, Quality degrades twice as fast
- The Quality of an item is never negative
- **"Apple AirPods"** actually increases in Quality the older it gets
- The Quality of an item is never more than 50
- **"Samsung Galaxy S23"**, being a legendary item, never has to be sold or decreases in Quality
- **"Apple iPad Air"**, like **"Apple AirPods"**, increases in Quality as its SellIn value approaches;
- `Quality` increases by `2` when there are `10` days or less and by `3` when there are `5` days or less but
- `Quality` drops to `0` after the concert

We have recently signed a supplier of conjured items. This requires an update to our system:

- **"Xiaomi Redmi Note 13"** items degrade in `Quality` twice as fast as normal items

Feel free to make any changes to the `UpdateQuality` method and add any new code as long as everything still works correctly. 
However, do not alter the Item class or Items property as those belong to the goblin in the corner who will insta-rage and one-shot you as he doesn't believe in shared code ownership (you can make the `UpdateQuality` method and `Items` property static if you like, we'll cover for you).

Just for clarification, an item can never have its `Quality` increase above `50`, however **"Samsung Galaxy S23"** is a legendary item and as such its `Quality` is `80` & it never alters.

## Folders

- `src` - contains the two classes:
    - `Item.php` - this class should not be changed
    - `WolfService.php` - this class needs to be refactored, and the new feature added

## 🎯 Goal
- Refactor the `WolfService` class to make any changes to the `UpdateQuality` method and add any new code as long as everything still works correctly.
- Store the `Items` in a storage engine of your choice. (e.g. Database, In-memory)  
- Create a console command to import `Item` to our inventory  from API `https://api.restful-api.dev/objects` (https://restful-api.dev/). In case Item already exists by `name` in the storage, update `Quality` for it.
- Provide another API endpoint to upload `imgUrl` via [https://cloudinary.com](https://cloudinary.com/documentation/php_image_and_video_upload) (credentials will be sent in email's attachment) for the `Item`. API should be authentication with basic username/password login. The credentials can be hardcoded.
- Unit testing.

## 💡 Hints before you start working on it
* Keep KISS, DRY, YAGNI, SOLID principles in mind.
* Your code should be tested

## How to submit your work
- You can do with Laravel or Symfony framework.
- Start by creating a new Git repository on a platform like GitHub, GitLab, or Bitbucket (all the code is your IP)
- Create README.md for the project with the setup instruction
- The server must be able to run and tested based on the README instructions
- Upload the Postman workspace
- Share the public git repository URL

### Bonus:
- Dockerize the application
- CI/CD skeleton
- Server scalability

## Recommendations
- Read the features and the bonus features carefully before you start coding
- Committing changes at appropriate intervals in Git
- Leave TODO in the code if you couldn't finish a solution, you have chance to explain it during the interview

**Happy coding**!
