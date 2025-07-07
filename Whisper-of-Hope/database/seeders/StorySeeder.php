<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class StorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();
        DB::table('stories')->insert([[
            'id'          => Str::uuid(),
            'title'       => 'Naomi Stays Strong Through It All',
            'image'       => 'Blog1.png',
            'content'     => 'Naomi is 12 years old, has 3 siblings, and plays the violin. She loves to eat pambazos (a popular Mexican sandwich coated in a spicy sauce and filled with potatoes and chorizo) and play with her dogs. She listens to music, plays rhythm games, watches anime, and enjoys spending time with her family.

            In December, she was diagnosed with osteosarcoma, a type of bone cancer. Now, instead of camping, eating smores and sharing scary stories by the fire, Naomi is undergoing chemotherapy treatments and dealing with hospital stays.

            Naomi kept her hair long and lost it with chemotherapy treatments. But soon, a new hairpiece will be arriving for Naomi, and at no cost to her family, thanks to the generosity of our hair and financial donors.

            Recently, Naomi and her family met with stylist Sherrill Graff of Creative Hair and Nails for their first of two appointments. In this measurement appointment, Sherrill and the family work together to select the perfect cap size, length and color for Naomi\'s hairpiece, so she can look the way she remembers. Naomi\'s family even included a ponytail donation when they returned their measurement kit!',
            'category_id' => 1,
            'created_at'  => $now,
            'updated_at'  => $now,
        ],[
            'id'          => Str::uuid(),
            'title'       => 'Maria Garcia Knows It\'s Not Just About Hair - It\'s About Hope',
            'image'       => 'Blog2.png',
            'content'     => 'Wigs For Kids is honored to have stylist Maria Garcia share her time and talents with Wigs For Kids as a Certified Service Provider, working directly with recipient families in the measuring and styling of the hairpieces. Maria is the owner of Alternative Hair Couture in Chicago\'s North Shore and began working with Wigs For Kids in 2020.

            Maria has been in the hair loss industry for over 23 years. She is a Trichologist, Hair Replacement Artist, Fine Hair Specialist, and Educator who has a passion for life long learning. She continues to hone her skills and keeps up with new trends through continuous education both domestically and internationally. In her salon, Maria and her team aim to leave clients feeling uplifted, relaxed and with renewed confidence, which aligns perfectly with Wigs For Kids\' mission.

            Throughout her career, Maria has worked with many children and adults experiencing hair loss. There are many reasons for hair loss that extend to both children and adults, such as stress-induced hair loss, alopecia, skin conditions, and hair loss from chemotherapy and other medications. 

            In working with these clients, Maria offers support tailored to each client\'s needs and validates their emotions. “I help my clients understand the root cause of their hair loss, whether it\'s due to genetics, medical conditions, stress, or other factors.”

            Maria shares that working with children dealing with hair loss has been deeply impactful for her. “Kids have different struggles. They know classmates will make comments about their hair, and it\'s usually not in the most positive ways. I\'ve learned that the most important thing is to provide a supportive and understanding environment, and I love that my daughter has been part of the volunteering experiencing since Day One.”',
            'category_id' => 1,
            'created_at'  => $now,
            'updated_at'  => $now,
        ],[
            'id'          => Str::uuid(),
            'title'       => 'Recipient Alexia Gets Her Long Hair Back Through Wigs For Kids',
            'image'       => 'Blog3.png',
            'content'     => 'Wigs For Kids celebrates Alexia, an eleven year old who loves ballet and her dog Cali. Last October, Alexia was diagnosed with leukemia, which meant frequent visits to the hospital and the start of chemotherapy.    

            Alexia herself wasn\'t as concerned about her hair loss and began to embrace her new look, but she also wanted the option to wear hair when she wanted.

            That\'s when Alexia and her family applied to the Wigs For Kids Recipient Program, where children experiencing medical hair loss are provided hand-tied hairpieces made from donated hair at no cost to the family. Wigs For Kids is able to provide these hairpieces free of charge to recipient families thanks to generous hair and financial donors.

            Alexia worked with Certified Service Provider Shalamar Rogers of Continued Beauty Lounge in San Diego. The first appointment centered around taking measurements for the hairpiece, to ensure a comfortable fit that would stay in place even during pirouettes. After selections were made for cap size, length, and color, Alexia\'s hairpiece went into creation.

            Once the hairpiece was ready, the family returned to Shalamar\'s salon for styling. They also learned how to care for her hairpiece with products provided by Wigs For Kids!

            Now Alexia has the option to wear hair when she chooses! Following the styling appointment, Alexia\'s mom Aimee shared, “It was wonderful! Our stylist was so sweet and caring! Alexia has been feeling confident wearing the wig and excited to have a new look.”

            Aimee was so moved by the gift that she donated 14 inches of her own hair so it could be used to create a hairpiece for another child. She shared, “I did it in [Alexia\'s] honor. You can cut off as much as you need to as long as I can give back and bring joy to another family.”',
            'category_id' => 1,
            'created_at'  => $now,
            'updated_at'  => $now,
        ],[
            'id'          => Str::uuid(),
            'title'       => 'Meet Hannah: A Wigs For Kids Super Hair-O',
            'image'       => 'Children1.png',
            'content'     => 'We\'re so proud of 12 year-old Hannah, who has decided to use her super-power of fast growing hair to make her 4th impactful hair donation to Wigs For Kids.

            Hannah recently donated an incredible 30 inches of hair so that another child could love their hair!

            Hannah began donating her hair at the age of 6, and shares, “I do this to make the kids happy, it\'s the least I can do on my part. I want to put a smile on their face and make them look beautiful.”

            Hannah\'s first donation to Wigs For Kids was 17 inches, then 2 years later she donated another 21 inches and just recently sent in another 30 inches!!

            We are in awe of Hannah\'s dedication to making life better for the children we serve.',
            'category_id' => 2,
            'created_at'  => $now,
            'updated_at'  => $now,
        ],[
            'id'          => Str::uuid(),
            'title'       => 'Sabella Shares Her Hair to Help Others',
            'image'       => 'Children2.png',
            'content'     => 'At just 3 and a half years old, Sabella\'s heart was touched by a simple ad, sparking a profound wish: to share her hair with children facing leukemia. This tender empathy blossomed into a tradition. On her 5th birthday, her first precious ponytail was sent off.

            Now, on her 7th birthday, with hair long and healthy once more, Sabella isn\'t just donating — she\'s inspiring a wave of support to help Wigs For Kids craft her gift into a tangible symbol of hope for others. Her youthful compassion is turning into a powerful act of kindness, one snip at a time.

            In addition to donating her hair for the second time, Sabella is hosting a fundraiser to help cover the costs of producing a hairpiece for a child in need. For more than 40 years, Wigs For Kids has been providing high quality hairpieces, created from donated hair, to children experiencing medical hair loss. These hairpieces, along with maintenance products, are provided at no cost to the families.

            We hope you will join Sabella in helping children look themselves and live their lives! Sabella is offering Thank You cards to all donors who contribute $50 or more to her campaign, which include a special drawing from Sabella! You can support her campaign here, or pledge to grow your hair to help a child unable to grow their own. To be prepared for your next cut, you can review our hair donation requirements here.',
            'category_id' => 2,
            'created_at'  => $now,
            'updated_at'  => $now,
        ],[
            'id'          => Str::uuid(),
            'title'       => '6 Year Old Sophia Shares Her Blessings',
            'image'       => 'Children3.png',
            'content'     => 'Meet Sophia. She is 6 years old and has thick, long blonde hair, which her mother admits, can be a little hard to manage.
            Sophia\'s mom told her daughter she had the option to donate her hair, and how that donation would be used to make wigs for kids battling medical issues. She explained that these kids were having trouble growing their own hair, but Sophia\'s hair would continue to grow and she could donate it all over again if she wanted to.

            The idea sparked excitement in Sophia, who then said, “God blessed me with beautiful hair, so I want to share!“

            Sophia and family went to Great Clips in Eagle Mountain, Utah for her donation cut.

            Sophia\'s generosity will positively impact the life of a child wishing for hair. This precious gift will take one stress away from a child dealing with medical hair loss.

            Sophia\'s ponytails will be combined with other donors\' hair to create a hand-tied hairpiece for a child experiencing hair loss. Each year, more and more families reach out requesting our hairpieces, which are provided at no cost to the families. Hair and financial donations allow us to continue our mission to help children look themselves and live their lives!

            Sophia\'s mom shared, “I hope these kids know they are beautiful with or without hair. But we really hope they love Sophia\'s shared hair for themselves. Sophia loves to help others and would love to meet them and give them big hugs and be their best friend is she could. She has a very big heart and loves everyone, so I\'m sure she would say she loves them too.”',
            'category_id' => 2,
            'created_at'  => $now,
            'updated_at'  => $now,
        ],[
            'id'          => Str::uuid(),
            'title'       => 'Hair Today, Gone Tomorrow',
            'image'       => 'Hair1.png',
            'content'     => 'Since 2020, Reed had been growing out his hair. At the end of November, he decided it was time for a cut, and that he wanted to donate his hair to Wigs For Kids. In a live Facebook post, Reed snipped each ponytail and talked about his decision to donate. He shared, “It\'s important for children to have confidence — Hair does that.”

            Reed gets to the core of our mission — Helping Children Look Themselves and Live Their Lives. Each hairpiece we provide to children experiencing medical hair loss removes an obstacle from their daily life.

            Partnered with his hair donation, Reed has set up a fundraiser to help cover the financial cost associated with producing a hairpiece for a child in need. We encourage you to support his efforts here!

            As Reed put it in his live donation, “Consider how great it would be to make a kid smile — \'cause really, what else is there?”',
            'category_id' => 3,
            'created_at'  => $now,
            'updated_at'  => $now,
        ],[
            'id'          => Str::uuid(),
            'title'       => 'Kelly\'s Ready to Buzz It Forward',
            'image'       => 'Hair2.png',
            'content'     => 'Kelly\'s mission is to make a meaningful impact on the lives of children facing hair loss by donating her hair and raising funds for Wigs For Kids. As someone who believes in the power of health and well-being, she recognizes that confidence and self-esteem are vital components of a child\'s happiness. Kelly is shaving her head on January 1, to raise awareness about children facing hair loss and to support kids in need, empowering them to embrace their uniqueness.

            You can join Kelly in her fundraising efforts by clicking here!',
            'category_id' => 3,
            'created_at'  => $now,
            'updated_at'  => $now,
        ],[
            'id'          => Str::uuid(),
            'title'       => 'M2L Performance Fundraiser - A Donation 7 Years in the Making',
            'image'       => 'Hair3.png',
            'content'     => 'Garrison has been growing his hair for the past seven years and has decided it is time for a new look, and has chosen to donate his hair to Wigs For Kids. Along with his hair donation, Garrison is fundraising to help offset the cost of the production of a hair replacement system (wig) for a child in need.

            Wigs For Kids provides hairpieces for children experiencing medical hair loss stemming from chemotherapy, alopecia, trichotillomania, radiation therapy, burns, and other medical causes. These hairpieces are hand-tied from our natural hair donations.

            Donated hair and finances are equally important to provide wigs to children. It takes approximately 20 to 30 ponytails and $1,800 to make one wig and each wig is provided at no cost to the recipient or their family. Wigs For Kids also provides one year\'s worth of hair products to each recipient to help them properly care for their wig. We always appreciate a combination of hair and financial donations because the two work together to provide a wig.',
            'category_id' => 3,
            'created_at'  => $now,
            'updated_at'  => $now,
        ],[     
            'id'          => Str::uuid(),
            'title'       => 'Lilyanna Gains Confidence and Joy',
            'image'       => 'Recipient1.png',
            'content'     => 'Meet Lilyanna, a Wigs For Kids Recipient. At the young age of one, she began to experience hair loss due to alopecia universalis.  Her mother, Danielle explained that when Lilyanna\'s hair loss occurred, she was too young to understand the significance of her autoimmune disease.

            Now that Lilyanna is in preschool, she has become more conscientious about her hair loss. She asked Danielle if the doctors could “fix her” and shared that she doesn\'t feel beautiful. Danielle\'s comforting words to Lilyanna are, “You are smart, beautiful and special, no matter what!”

            Danielle stated that she is extremely grateful to Wigs For Kids for providing Lilyanna her wig. And to Certified Service Provider Rachel McElvaney from Beautiful Day Salon for working with Lilyanna on the styling and care of her wig. Rachel and Lilyanna have developed a relationship sharing “tons of laughs.”

            Danielle\'s words of advice to parents with children facing illnesses and hair loss, “Keep your child busy with activities, friends, and family. Let them know they are loved, and safe. I want Lilyanna to always be laughing, to feel safe and comfortable to allow her beautiful soul to shine through.”

            Wigs For Kids aims to restore confidence to children experiencing medical hair loss, so that they can live their lives just like all their peers, without worry of feeling different based on their appearance. We provide hand-tied hairpieces made from our donors at no cost to the family.

            Thanks to generous financial and ponytail donors, and stylists across the US who donate their time and talents, Lilyanna can look forward to “having expensive hair for school.”',
            'category_id' => 4,
            'created_at'  => $now,
            'updated_at'  => $now,
        ],[
            'id'          => Str::uuid(),
            'title'       => 'Paisley Loves Minecraft and Spongebob',
            'image'       => 'Recipient2.png',
            'content'     => 'Meet Paisley. Paisley is 9 years old and and is in 3rd grade. She\'s like many children her age: she looks up to her parents, loves eating pizza and ice cream, and plays video games, with her favorite being Minecraft.

            Unlike many of her friends, Paisley has been diagnosed with Alopecia, an autoimmune disease that affects about 1 in every 1,000 children.

            Paisley shared that dealing with hair loss has made her feel “happy and sad at the same time.”

            Through the Wigs For Kids Recipient Program, Paisley received a hand-tied hairpiece made of donated, human hair and the products needed for its care and upkeep at no cost to her family.

            Wigs For Kids aims to restore confidence to children experiencing medical hair loss, so that they can live their lives just like all their peers, without worry about standing out or feeling othered based on their appearance.

            Paisley worked with hair stylist Samantha Smith of Alter Ego Haircolor and Design Studio. Samantha is a Certified Service Provider for Wigs For Kids. She has been trained and certified to work with children like Paisley who are experiencing hair loss.

            In their first visit, Samantha measured Paisley\'s head to ensure the right fit for her hairpiece. Then, once the hairpiece arrived, Paisley\'s family returned to the salon to learn how to take care of her new, long hair.

            Thanks to generous financial and ponytail donors, and stylists like Samantha who donate their time, kids like Paisley regain the opportunity to look themselves and live their lives.',
            'category_id' => 4,
            'created_at'  => $now,
            'updated_at'  => $now,
        ],[
            'id'          => Str::uuid(),
            'title'       => 'Recipient Aaliyah Thanks You',
            'image'       => 'Recipient3.png',
            'content'     => 'We received a note from one of our recipients we wanted to share with you.

            Wigs for Kids,

            My name is Aaliyah and I just want to thank you from the bottom of my heart for making me a wig.

            I feel so much better, I am doing good in my classes now at school.
            I can run and jump, play gym.

            I am very happy, and I thank you so much.

            Here is a picture of my hair, I got it in a ponytail. I hope you can make other kids as happy as you made me.

            
            Love,

            Aaliyah',
            'category_id' => 4,
            'created_at'  => $now,
            'updated_at'  => $now,
        ]]);
    }
}
