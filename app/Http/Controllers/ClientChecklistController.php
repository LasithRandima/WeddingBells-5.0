<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\ClientChecklist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClientChecklistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rowcount = DB::table('users')->count();
        $records = DB::table('client_checklists')->where('c_id', Auth::id())->count();
        // $cid = DB::scalar('SELECT id FROM users where role_id=3 order by id desc limit 1');
        $cid = Auth::id();
        $create_date_time = Carbon::now()->toDateTimeString();
        app('debugbar')->info($records);


        // if($cid == $rowcount){
        //  DB::unprepared('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',






// if($cid == $rowcount)
if($records == 0){
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Announce your engagement to family and friends!','Congratulations on your engagement! Spread the word to family and friends.','Planning','From 10 to 12 months',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Plan an engagement party',"It's time to party! Your family and friends can't wait to celebrate your big news.",'Planning','From 10 to 12 months',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Start researching venues','Narrowing down a location and season will help you start researching venues. We recommend being flexible with your date until you find the perfect place!','Planning','From 10 to 12 months',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Schedule an engagement photoshoot','Many couples use photos from their engagement shoot for their save the dates. Use this as an opportunity to show your personality!','Photography and Video','From 10 to 12 months',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Start your guest list','Our Guest List Tool helps you keep track of everything from RSVPs to dietary requirements, all in one place!','Planning','From 10 to 12 months',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Explore our Ideas section and Real Weddings for advice and inspiration!','Trending topics, questions, etiquette and wedding inspo from other couples can all be found under Wedding Ideas.','Planning','From 10 to 12 months',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Figure out your budget',"Determine what you're willing to spend and who is paying for what. Our Budget Tool can help you stay on track of your spending!",'Planning','From 10 to 12 months',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Research and book a wedding planner',"Whether you're staying local or having a destination wedding, it may make sense to hire a professional planner to help things go smoothly.",'Planning','From 10 to 12 months',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Research religious officiants, celebrants or registrars',"Decide whether you will have a religious or civil ceremony, have an initial meeting with your religious official or registrar and choose your ceremony venue. If you''re having a celebrant, you will need a legal ceremony first.",'Ceremony','From 10 to 12 months',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Choose a theme and colour scheme','What shades will take centre stage at your wedding? Remember consider your season, venue and theme when selecting your dream colour scheme.','Planning','From 10 to 12 months',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Download the Hitched App','Plan and manage your wedding on-the-go with our Checklist, Guest List, Seating Plan and Budget Tool (and more!) at your fingertips.','Planning','From 10 to 12 months',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Select your wedding party',"It's an honour to be included in your wedding party. Appoint your wedding party, which may include a maid of honour, bridesmaids, best man and ushers",'Planning','From 10 to 12 months',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Research venues with a few dates in mind',"Now that you've narrowed down where and when, pick a few dates and set up some appointments to tour the facilities. Also make sure to compare what each venue includes in their packages.",'Ceremony','From 10 to 12 months',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Start your registry','Browse local and online options that best fit your newlywed needs.','Gift list','From 10 to 12 months',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Start collecting guest list information',"It's time to reach out for those addresses, emails and phone numbers - you can start saving all of this information in the Guest List Tool.",'Planning','From 10 to 12 months',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Book your venue and set the date!',"It''s time to reserve the ceremony and reception spaces you'll need for the big day, and officially set the date.",'Reception','From 10 to 12 months',NULL,1,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Reserve your catering','The average couple contacts nine caterers before selecting one, so choose carefully!','Reception','From 10 to 12 months',NULL,1,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Create your wedding website','Share your love story, collect RSVPs and add travel and accommodation information. Each site also comes with a custom guest app!','Planning','From 10 to 12 months',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Research and meet a few photographers','Style, personality and budget are the three most important factors in choosing a photographer. Your wedding photos will be one of the most important memories of your big day, so take plenty of time to look around.','Photography and Video','From 10 to 12 months',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Create a weather "Plan B"','Rain, snow or whatever the weather might bring, talk to your venue to discuss a Plan B. Be prepared!','Reception','From 10 to 12 months',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Research music and entertainment for your reception','Do you want a live band or a DJ? Will you want a photobooth, a mobile bar, a fireworks display? Start planning now.','Music','From 10 to 12 months',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Meet with a few photographers','Style, personality and budget are the three most important factors in choosing a photographer.','Photography and Video','From 10 to 12 months',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Start looking at wedding outfits','Dresses, suits or bridesmaid gowns! Start shortlisting your favourite looks','Bride accessories','From 10 to 12 months',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Revise your guest list',"Now that you''ve chosen your venue, make any necessary adjustments to the guest list. Do you want to add or trim numbers?",'Planning','From 10 to 12 months',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Confirm your wedding party',"Your inner circle will make you feel your best on your big day. Now's your chance to pop the question to them and ask them to stand by your side.",'Other','From 10 to 12 months',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Book your photographer',"Take time to schedule a follow-up chat in a few months once you've had a chance to research more angles and poses you like.'",'Photography and Video','From 10 to 12 months',NULL,1,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Create and order your save the dates',"It's time to start designing your first pieces of wedding stationery! Personalise your save the dates with your wedding colour scheme, engagement photos and/or a few fun graphics.",'Wedding invitations','From 10 to 12 months',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Book your reception musician, entertainer, band and/or DJ','Get ready to walk down the aisle, then hit the dance floor!','Music','From 10 to 12 months',NULL,1,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Start researching wedding party attire','Bridesmaids dresses or jumpsuits, groomsmen suits or tuxes, mix and match as you please!','Other','From 7 to 9 months',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Come up with a wellness plan','Eating right and exercise will help alleviate pre-wedding stress, making you happier and more relaxed!','Health and beauty','From 7 to 9 months',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Reserve hotel rooms for your guests','Block out hotel rooms for guests at your accommodation. Make sure to put hotel information on your wedding website so guests can stay in the know.','Planning','From 7 to 9 months',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Start researching videographers','Journalistic, cinematic, traditional? There are many styles to choose from!','Photography and Video','From 7 to 9 months',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Start looking at florists','Fresh, silk or a mix of both - find blooms and greenery that go with your theme and colour scheme.','Flowers and Decoration','From 7 to 9 months',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Contact your local registry office','Requirements can vary by region and registrars can get booked up far in advance for popular dates. Get in touch now and start the ball rolling.','Legal processes','From 7 to 9 months',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Book your videographer','Some moments, like the vows and speeches, are best caught on film. Book a videographer who understands what you want.','Photography and Video','From 7 to 9 months',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Research decorations for your ceremony and reception','Lighting, centrepieces, balloons, vintage rentals? Look around at our suppliers to get inspired.','Flowers and Decoration','From 7 to 9 months',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Start researching invitation designers','Whether local or online, start looking around to get some ideas for your wedding stationery - schedule some appointments, too!','Wedding invitations','From 7 to 9 months',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Book your florist',"Another professional joins your supplier team - and you're one step closer to tying the knot!",'Flowers and Decoration','From 7 to 9 months',NULL,1,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Research wedding rings','Gold, silver, platinum - the options go on and on!','Jewellery','From 7 to 9 months',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Start looking at honeymoon destinations',"Tropical, mountain, beach there's plenty to choose from! Research destinations for your first holiday as a married couple.",'Honeymoon','From 7 to 9 months',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Make appointments at wedding boutiques and/or suit shops','Bring a small entourage who will support you and help find your style.','Bride accessories','From 7 to 9 months',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Choose your wedding attire and schedule your first fitting','You said yes! Congrats on finding that special something that makes you look and feel your best.','Bride accessories','From 7 to 9 months',NULL,1,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Update your supplier team',"You've started assembling the dream team! Add them to My Suppliers to help you stay on top of every last detail.",'Planning','From 7 to 9 months',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Download the WedShoots App',"Create your wedding-specific code and share with your guests - unlimited photos, shared instantly, so you don't miss a single moment. Make sure the code is easy to find on your wedding website!",'Other','From 4 to 6 months',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Meet with your religious officiant, celebrant or registrar',"This is the person who helps you say, 'I do.' You may not meet your registrar until the day, but you''ll likely have a couple of appointments with your religious officiant or celebrant before the big day. Try to schedule a later consultation with them closer to the big day to finalise the ceremony timeline.",'Ceremony','From 4 to 6 months',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Research rentals like marquees, place settings, chairs, and aisle runners','Personalise your decorations to make your venue feel unique.','Flowers and Decoration','From 4 to 6 months',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Research headpieces and veils','Cathedral length veils, flower crowns and hair vines - look around and save your favourites.','Bride accessories','From 4 to 6 months',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Create a gift list','Personalise your gift list based on your needs. Make sure to include a variety of items and price points.','Gift list','From 4 to 6 months',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Confirm your honeymoon plans','Relaxing as newlyweds is just around the corner!','Honeymoon','From 4 to 6 months',NULL,1,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Research cake makers and schedule a tasting','Traditional tiers, cupcakes, macarons or doughnuts - you name it, your guests will love it!','Reception','From 4 to 6 months',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Send save the dates','Make sure that the addresses you have are up-to-date. Include your wedding website URL for anyone who might not have it.','Wedding invitations','From 4 to 6 months',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Order your invitations and thank you cards',"Don't forget envelopes! Sometimes couples opt to use the same designer for their menu and order of service - it''s up to you. A bulk order can save you money.",'Wedding invitations','From 4 to 6 months',NULL,1,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Book your wedding musician(s)','A band, string quartet, guitarist, DJ, harpist - book your music act for every stage of your day.','Music','From 4 to 6 months',NULL,1,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Book rental, decoration and lighting professionals','Photobooth, chairs, chandeliers? Time to book!','Reception','From 4 to 6 months',NULL,1,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Book transportation for you and for your guests','Classic car, double decker bus, ferry? You name it, you can find it in our directory of transportation suppliers.','Transport','From 4 to 6 months',NULL,1,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Research rehearsal dinner locations','If you choose to have one, decide whether you want a casual meal or take over a trendy restaurant? Keep in mind the number of guests.ests.','Other','From 4 to 6 months',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Start researching hair and makeup suppliers',"Time to find your glam squad! Start searching for the perfect makeup and hair team that'll transform you on your wedding day.",'Health and beauty','From 4 to 6 months',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Book your cake maker','Sweet!','Reception','From 4 to 6 months',NULL,1,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,"Prepare to send the invitations - confirm guests addresses!",'Make sure that the addresses you have are up-to-date.','Wedding invitations','From 4 to 6 months',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Book your hair and makeup professionals','Book in at least one hair and makeup trial before your big day to finalise your look.','Health and beauty','From 4 to 6 months',NULL,1,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Use your wedding website to collect information from your guests (RSVPs, meal selections, etc.)',"Meals, songs, who needs a hotel room, and who's bringing a plus one - all of this can be collected through your wedding website.",'Planning','From 4 to 6 months',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Begin the first steps to legally get married',"Gather documents to take to your local registry office (proof of ID, address, etc.) It's really happening!",'Legal processes','From 4 to 6 months',NULL,1,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Buy or hire male wedding party suits',"It's time for the groom/grooms and groomsmen to find their perfect look",'Groom accessories','From 4 to 6 months',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Book accommodation for your wedding night','Your venue may have a honeymoon suite. If not, find yourself somewhere romantic nearby.','Other','From 4 to 6 months',NULL,1,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Arrange the wedding rehearsal',"Practice makes perfect! Your ceremony venue may contact you to offer you a date to come in with your wedding party and practice where you'll walk and stand.",'Other','From 4 to 6 months',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Make sure your wedding party has ordered their outfits',"Follow up with an email or phone call to make sure everyone's outfit has been ordered.",'Other','From 4 to 6 months',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Order your wedding favours',"Thank your guests with some personalised presents! If you''re extra crafty, you can even go the DIY route.",'Wedding favours','From 4 to 6 months',NULL,1,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Think of wedding ring engravings','Quotes, dates, initials? It makes your rings even more special.','Jewellery','From 4 to 6 months',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Purchase outfit accessories',"Shoes, jewellery, headpieces, pocket squares - don't forget all of the little details",'Bride accessories','From 2 to 3 months',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Address and send your wedding invitations','One more thing accomplished! Look at you go. If you need some help, rope in your wedding party.','Wedding invitations','From 2 to 3 months',NULL,1,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Purchase your guest book',"Guest books come in all shapes and sizes - find one that's right for you and your theme.",'Reception','From 2 to 3 months',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Purchase your wedding rings','Put a ring on it!','Jewellery','From 2 to 3 months',NULL,1,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Research/book a day-of-coordinator','Make the day run smoother and take some stress off the coordination between suppliers. Your venue may supply you with one; make sure to ask.','Planning','From 2 to 3 months',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Check on passports, vaccines and visas!',"Whether you're having a destination wedding or an adventurous honeymoon, make sure you have all your ducks in a row to travel.",'Honeymoon','From 2 to 3 months',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Think of a signature cocktail','Take your cocktail hour to the next level with a couple of signature drinks.','Other','From 2 to 3 months',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'If you want a hair cut, go now!','Six weeks before your wedding is ideal to keep your hair looking healthy and have a hair trial with your new look.','Health and beauty','From 2 to 3 months',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Purchase a wedding gift for your spouse-to-be','Pass them along a surprise gift to open on the wedding wedding that tells them they mean the world to you.','Other','From 2 to 3 months',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Think of something unique!','You and your partner have a one-of-a-kind love - think of something fun and special to make your wedding day true to you! Bubbles, sparklers, lanterns?','Other','From 2 to 3 months',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Sit down with your photographer again',"By now you should know if you''d like to do a first look and what kinds of shots you'd like. Don't forget to confirm all timeline details.",'Photography and Video','From 2 to 3 months',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Decide on hair and makeup styles','Up, down, natural or dramatic - the choices are endless. Pinterest will be your best friend here.','Health and beauty','From 2 to 3 months',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Double check with your transportation','Make sure to communicate time, place, vehicles and if there are any guests with special needs.','Transport','From 2 to 3 months',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Order any wedding party accessories','Socks, headbands, bracelets? Think of fun accessories for your wedding party!','Planning','From 2 to 3 months',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Check in with your religious officiant, celebrant or registrar and give notice','For most marriages or civil partnerships you must give at least 28 full days’ notice at your local register office. Now is the time to ask questions, ceremony details or seek a bit of advice.','Legal processes','From 2 to 3 months',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Confirm meal selections and notify caterer and dessert suppliers of any food allergies','Formal, family style, buffet or food truck, your food suppliers should be aware of any dietary needs (AKA allergies or restrictions).','Reception','From 2 to 3 months',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Book a bartending or alcohol service, if not included in your venue or catering','Pop, fizz, clink! If you choose to have alcohol at your wedding, now is the time to reserve it and decide on an open or cash bar.','Reception','From 2 to 3 months',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Hair and makeup trial!','Trials are so important - make sure to bring a friend who will give you an honest opinion and take pictures with plenty of natural light.','Health and beauty','From 2 to 3 months',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Finalise your wedding songs','Make sure to send this along to your band and/or DJ.','Music','From 2 to 3 months',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Make a packing list for your wedding/honeymoon',"But no need to overpack - you'll probably want souvenirs!",'Honeymoon','From 2 to 3 months',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Create your ceremony and reception timelines','Think of a start and finish time, and leave plenty of space for dancing!','Planning','From 2 to 3 months',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Order your place cards, menus and orders of service','Include timing, readings, participants and any additional fun details you think your guests will enjoy.','Wedding invitations','From 2 to 3 months',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Make sure your wedding party knows the timeline',"When to be where, who's reading what, and how to help make everything go as smoothly as possible.",'Planning','From 2 to 3 months',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Buy wedding party gifts','Think of a meaningful way to thank your wedding party for being the best entourage ever.','Other','From 2 to 3 months',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Start thinking of your vows and speeches',"No pressure here - remember, you''re just reciting these in front of all your family, friends and loved ones. Will you write your own vows or give a speech?",'Planning','From 2 to 3 months',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Double check your orders of service and place cards','Your stationary designer should send you a sample so make sure every name is right and all the details are correct.','Ceremony','From 2 to 3 months',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Pick up your rings',"Wow - it's really happening!",'Jewellery','The last month',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,"Review the guest list and call guests that haven't RSVP'd",'Give them a ring and remind them your big day is coming up.','Planning','The last month',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Finalise vows',"Dot your I's and cross your T's!",'Planning','The last month',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Have another dress or outfit fitting','This is the homestretch for tailoring - make an appointment to try on your outfit one last time when you pick it up in a few weeks.','Bride accessories','The last month',NULL,1,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Confirm wedding rehearsal',"If you're having one, confirm the rehearsal ceremony and dinner timeline and attendance.",'Other','The last month',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Finalise and share the seating plan with your reception venue',"Final touches here - as soon as you''re finished, send it to your venue.",'Reception','The last month',NULL,1,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Make sure the speeches are ready',"Get ready to make a toast! (Don't forget tissues).",'Reception','The last month',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Start practising for your first dance','Many couples opt for dance classes - or even something choreographed with their wedding party!','Music','2 weeks',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Pamper yourself!',"If you want a fringe trim, manicure or a deep conditioning treatment, treat yourself.",'Health and beauty','2 weeks',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Confirm your witnesses',"Not long to go now! Make sure your witnesses know what they'll need to do on the day (it's just a signature, don''t worry).",'Legal processes','2 weeks',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,"Pick up you and your partner's wedding outfits","Have your final fitting and bring the outfit home if it's ready. Put it somewhere where the other person wouldn't be able to take a peek!",'Bride accessories','Last week',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Confirm details with wedding party',"Make sure everyone knows what they're responsible for and the timeline for the big day.",'Planning','Last week',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Confirm final details with all your suppliers and send last payments','Make sure your supplier team is paid in full before the day.','Planning','Last week',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Pack for your honeymoon',"Wherever you go, sunglasses are a must! Don't forget your passport and any other travel documents necessary.",'Honeymoon','Last week',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Write a sweet note to your partner','Send a love letter to your spouse-to-be for when they are getting ready for the wedding.','Other','Last week',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Pull together any last-minute essentials','Safety pins, tissue, ibuprofen, a pen and bottled water are just a few suggestions.','Other','Last week',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Drop off decor to the venue(s)','Drop off place cards, menus, favours, the guest book, and any other items to your venue.','Flowers and Decoration','Last day',NULL,1,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,"Smile. You're finished!","Celebrate a job well done and get some rest - you've got a big day tomorrow.",'Other','Last day',NULL,0,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Submit your Real Wedding','We want to hear every last detail! Share all of the moments that made your big day so special and inspire other engaged couples with your photos.','Other','After the wedding',NULL,1,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Review your supplier team on Hitched','Don’t forget to thank the team who made your wedding unforgettable! Sharing your experience will also help other engaged couples choose suppliers for their big day.','Other','After the wedding',NULL,1,0]);
  DB::insert('INSERT INTO client_checklists (id, c_id, created_at, updated_at, task_name, description, Category, timing_period, date, essential, task_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                [NULL,$cid,$create_date_time,$create_date_time,'Download your Wedshoots album','Remind guests to add any remaining photos to your private Wedshoots album, then easily download so you can share your memories with family and friends.','Other','After the wedding',NULL,0,0]);

        }


        // return redirect()->route('checklist')->with('success','Checklist Has Been updated successfully');
        return view('customer.checklist')->with('success','Checklist Has Been updated successfully');

    }





    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClientChecklist  $clientChecklist
     * @return \Illuminate\Http\Response
     */
    public function show(ClientChecklist $clientChecklist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ClientChecklist  $clientChecklist
     * @return \Illuminate\Http\Response
     */
    public function edit(ClientChecklist $clientChecklist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ClientChecklist  $clientChecklist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClientChecklist $clientChecklist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClientChecklist  $clientChecklist
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClientChecklist $clientChecklist)
    {
        //
    }
}
