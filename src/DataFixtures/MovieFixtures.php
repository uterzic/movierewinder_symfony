<?php

namespace App\DataFixtures;

use App\Entity\Movie;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;

class MovieFixtures extends Fixture implements DependentFixtureInterface
{
    private $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }
    
    public function load(ObjectManager $manager): void
    {
        $movie = new Movie();
        $movieTitle = 'The Dark Knight';
        $moviePublishDate = new DateTime('2024-03-12');
        $movie->setTitle($movieTitle);
        $movie->setReleaseYear(random_int(2000, 2024));
        $movie->setDescription("Christopher Nolan's The Dark Knight stands not only as a seminal entry in the superhero genre but also as a masterpiece of modern cinema. Released in 2008, it transcended the boundaries of comic book adaptations, elevating itself into the realm of timeless storytelling and philosophical exploration.
        At its core, 'The Dark Knight' is a gripping tale of chaos versus order, embodied by the enigmatic figure of the Joker, brilliantly portrayed by Heath Ledger in what would tragically become his final completed role. Ledger's portrayal of the Joker is nothing short of iconic, a chilling descent into madness that captivates and terrifies in equal measure. His performance is a tour de force of acting prowess, earning him a posthumous Academy Award for Best Supporting Actor and cementing the character as one of cinema's most memorable villains.
        But Ledger's Joker is just one facet of a film that boasts a wealth of complex characters and intertwining narratives. Christian Bale reprises his role as Bruce Wayne/Batman, grappling not only with the physical threats posed by Gotham City's criminal underworld but also with the moral dilemmas that come with being a symbol of justice. Bale brings depth and vulnerability to the character, showcasing Wayne's internal struggle with his own identity and the sacrifices he must make in his quest for justice.
        Opposite Bale's brooding Batman is the late Heath Ledger's anarchic Joker, a force of nature whose sole purpose is to sow chaos and dismantle the societal structures that Batman seeks to protect. Ledger's Joker is a revelation, a character fueled by nihilism and unpredictability, whose actions force Batman and the citizens of Gotham to confront their own values and beliefs. The dynamic between Batman and the Joker forms the thematic heart of the film, exploring the blurred lines between heroism and villainy, order and chaos.
        Beyond its stellar performances, The Dark Knight is a technical marvel, with Nolan demonstrating his mastery of the cinematic medium. The film's visual aesthetic is dark and gritty, perfectly complementing its bleak and morally ambiguous narrative. From the soaring skyscrapers of Gotham City to the claustrophobic confines of its underworld, Nolan crafts a world that feels both expansive and claustrophobic, a reflection of the moral decay that permeates every corner of the city.
        Nolan's direction is complemented by Hans Zimmer's haunting score, which pulsates throughout the film, heightening tension and underscoring the psychological drama unfolding on screen. Zimmer's use of recurring motifs, such as the Joker's eerie theme, further enhances the film's thematic depth, serving as a sonic representation of the chaos that threatens to consume Gotham.
        The Dark Knight is not merely a superhero film; it is a meditation on the nature of good and evil, of heroism and villainy. It poses difficult questions about the nature of justice and the sacrifices required to uphold it. In its exploration of these themes, the film holds a mirror up to society, forcing audiences to confront uncomfortable truths about the world we live in.
        Nearly a decade and a half since its release, The Dark Knight remains as relevant and impactful as ever. Its influence can be seen in the countless superhero films that have followed, many of which have sought to emulate its dark and gritty tone. Yet, none have been able to replicate its depth of character, its thematic richness, or its sheer cinematic power.
        In conclusion, The Dark Knight is a masterpiece of modern cinema, a film that transcends its genre to stand as a timeless work of art. With its unforgettable performances, masterful direction, and thought-provoking themes, it is a film that will continue to captivate audiences for generations to come.");
        $movie->setImagePath('https://cdn.pixabay.com/photo/2021/06/18/11/22/batman-6345897_960_720.jpg');
        $movie->setPublishDate($moviePublishDate);
        $slug = $this->slugger->slug($movieTitle)->lower();
        $movie->setSlug($slug);
        $movie->setReviwer($this->getReference('reviewerUser1'));
        $movie->setRating(random_int(5, 10));
        $manager->persist($movie);

        $movie2 = new Movie();
        $movie2Title = 'Avangers: Endgame';
        $movie2PublishDate = new DateTime('2024-03-13');
        $movie2->setTitle($movie2Title);
        $movie2->setReleaseYear(random_int(2000, 2024));
        $movie2->setDescription("Avengers: Endgame is not just a movie; it's a cinematic event that marks the culmination of over a decade of storytelling in the Marvel Cinematic Universe (MCU). Directed by Anthony and Joe Russo, this epic conclusion to the Infinity Saga delivers on every level, offering a deeply satisfying and emotional experience for fans.
        From the outset, Endgame grabs hold of your attention and never lets go. The film picks up where Avengers: Infinity War left off, with half of all life in the universe wiped out by Thanos' devastating snap. What follows is a rollercoaster of emotions as the remaining Avengers grapple with grief, guilt, and the daunting task of reversing the Mad Titan's actions.
        What sets Endgame apart is its impeccable balance of action, humor, and heart. The Russo brothers masterfully blend intense battle sequences with poignant character moments, ensuring that every hero gets their chance to shine. From Captain America's unwavering resolve to Iron Man's journey of self-discovery, each character arc feels earned and satisfying.
        Moreover, Endgame is filled with surprises, callbacks, and Easter eggs that reward longtime fans for their investment in the MCU. It's a love letter to the franchise, packed with nostalgic nods and emotional payoffs that will leave audiences cheering, laughing, and, yes, crying.
        The visual effects are stunning, the score is stirring, and the performances are top-notch across the board. Robert Downey Jr., Chris Evans, Scarlett Johansson, and the rest of the ensemble cast deliver powerhouse performances, imbuing their characters with depth, humor, and humanity.
        In conclusion, Avengers: Endgame is a cinematic masterpiece that delivers an epic conclusion to the Infinity Saga while setting the stage for the future of the MCU. It's a testament to the power of storytelling and the enduring legacy of these iconic characters. Whether you're a die-hard Marvel fan or a casual moviegoer, Endgame is an experience you won't soon forget.");
        $movie2->setImagePath('https://cdn.pixabay.com/photo/2020/10/28/10/02/captain-america-5692937_1280.jpg');
        $movie2->setPublishDate($movie2PublishDate);
        $slug = $this->slugger->slug($movie2Title)->lower();
        $movie2->setSlug($slug);
        $movie2->setReviwer($this->getReference('reviewerUser1'));
        $movie2->setRating(random_int(5, 10));
        $manager->persist($movie2);

        $movie3 = new Movie();
        $movie3Title = 'Spiderman';
        $movie3PublishDate = new DateTime('2024-03-14');
        $movie3->setTitle($movie3Title);
        $movie3->setReleaseYear(random_int(2000, 2024));
        $movie3->setDescription("Spider-Man: Homecoming swings into action with a refreshing take on the iconic web-slinger, bringing youthful energy and humor to the Marvel Cinematic Universe (MCU). Directed by Jon Watts, this installment introduces Tom Holland as the charming and endearing Peter Parker, a high school student balancing the challenges of adolescence with his newfound responsibilities as Spider-Man.
        The film eschews the typical origin story, diving straight into Peter's life as a teenage superhero navigating the complexities of high school while also dealing with the villainous Vulture, portrayed with menacing gravitas by Michael Keaton. Keaton's portrayal adds depth and complexity to the antagonist, elevating him beyond a mere comic book villain and making him a formidable foil to Spider-Man.
        What sets Spider-Man: Homecoming apart is its focus on character-driven storytelling. Holland shines in the role, capturing both the awkwardness of adolescence and the heroic determination of Spider-Man with equal finesse. His dynamic with mentor figure Tony Stark, played with trademark wit by Robert Downey Jr., adds layers to Peter's journey as he learns valuable lessons about power, responsibility, and self-discovery.
        Visually stunning action sequences, witty dialogue, and a killer soundtrack further enhance the film's appeal, delivering a fast-paced and entertaining ride from start to finish. The supporting cast, including Zendaya as the quick-witted Michelle and Jacob Batalon as Peter's lovable best friend Ned, adds depth and humor to the ensemble, creating a compelling backdrop for Spider-Man's adventures.
        While Spider-Man: Homecoming may lack the epic scale of some other MCU entries, its focus on the personal struggles and triumphs of its characters makes it a standout addition to the franchise. It's a coming-of-age story wrapped in a superhero package, offering a fresh perspective on one of Marvel's most beloved heroes.
        In conclusion, Spider-Man: Homecoming is a delightful blend of action, humor, and heart, capturing the essence of what makes Spider-Man such an enduring and beloved character. With Holland's charismatic performance at its center, the film sets the stage for exciting new adventures in the MCU while paying homage to the classic elements that fans know and love. Whether you're a longtime Spider-Man fan or a newcomer to the world of superheroes, Homecoming is sure to leave you entertained and eager for more.");
        $movie3->setImagePath('https://cdn.pixabay.com/photo/2014/11/03/13/33/spiderman-515215_1280.jpg');
        $movie3->setPublishDate($movie3PublishDate);
        $slug = $this->slugger->slug($movie3Title)->lower();
        $movie3->setSlug($slug);
        $movie3->setReviwer($this->getReference('reviewerUser1'));
        $movie3->setRating(random_int(5, 10));
        $manager->persist($movie3);

        $movie4 = new Movie();
        $movie4Title = 'Captain America';
        $movie4PublishDate = new DateTime('2024-03-15');
        $movie4->setTitle($movie4Title);
        $movie4->setReleaseYear(random_int(2000, 2024));
        $movie4->setDescription("Captain America: The Winter Soldier stands as a pinnacle of the Marvel Cinematic Universe (MCU), blending the heart-pounding action of a spy thriller with the timeless heroism of its titular character. Directed by Anthony and Joe Russo, this sequel to Captain America: The First Avenger takes Steve Rogers, played with unwavering conviction by Chris Evans, on a journey of self-discovery and moral complexity as he grapples with the challenges of a modern world mired in political intrigue and deception.
        The film wastes no time plunging viewers into a high-stakes narrative filled with twists, turns, and edge-of-your-seat suspense. Rogers' struggle to reconcile his unwavering ideals with the murky realities of espionage is brought to the forefront when he uncovers a sinister conspiracy within the ranks of S.H.I.E.L.D., the organization he once trusted implicitly. The introduction of the enigmatic Winter Soldier, portrayed with chilling intensity by Sebastian Stan, adds an extra layer of tension and emotional depth to the story, challenging Rogers both physically and emotionally as he confronts his own past and the shadows that haunt him.
        What sets The Winter Soldier apart is its commitment to character-driven storytelling and its willingness to explore complex themes of loyalty, freedom, and sacrifice. Evans delivers a career-defining performance as Rogers, showcasing both the hero's unwavering resolve and his moments of vulnerability with equal skill. His dynamic with Scarlett Johansson's Natasha Romanoff, aka Black Widow, adds depth and nuance to both characters, highlighting their shared sense of duty and the bonds that unite them in the face of adversity.
        Visually stunning action sequences, grounded choreography, and a pulsating score by Henry Jackman elevate the film to new heights, immersing viewers in a world where every punch, every explosion, and every moment of quiet reflection carries weight and significance. The Russo brothers' expert direction keeps the pacing tight and the tension palpable, ensuring that audiences are kept on the edge of their seats from start to finish.
        At its core, Captain America: The Winter Soldier is more than just a superhero film; it's a meditation on the nature of heroism itself and the sacrifices required to uphold it in an imperfect world. With its thought-provoking themes, gripping action, and standout performances, it stands as one of the MCU's crowning achievements, setting a new standard for what superhero cinema can achieve.
        In conclusion, Captain America: The Winter Soldier is a masterclass in blockbuster filmmaking, seamlessly blending pulse-pounding action with genuine emotion and thought-provoking themes. It's a testament to the enduring appeal of the superhero genre and a shining example of how powerful storytelling and compelling characters can elevate a film beyond mere spectacle. Whether you're a die-hard Marvel fan or a newcomer to the MCU, The Winter Soldier is sure to leave you exhilarated, entertained, and eager for more.");
        $movie4->setImagePath('https://cdn.pixabay.com/photo/2022/06/05/11/06/action-figures-7243788_1280.jpg');
        $movie4->setPublishDate($movie4PublishDate);
        $slug = $this->slugger->slug($movie4Title)->lower();
        $movie4->setSlug($slug);
        $movie4->setReviwer($this->getReference('reviewerUser1'));
        $movie4->setRating(random_int(5, 10));
        $manager->persist($movie4);
        
        $movie5 = new Movie();
        $movie5Title = 'James Bond';
        $movie5PublishDate = new DateTime('2024-03-16');
        $movie5->setTitle($movie5Title);
        $movie5->setReleaseYear(random_int(2000, 2024));
        $movie5->setDescription("From the adrenaline-pumping opening chase to the heart-stopping climax, License to Thrill delivers non-stop excitement from start to finish. Lead Actor effortlessly embodies the suave sophistication and lethal charm of Agent 007, showcasing his versatility in both high-octane action sequences and moments of intense drama.
        The film's supporting cast shines brightly, with standout performances from Lead Actress as the enigmatic femme fatale and Supporting Cast as the formidable villain hell-bent on world domination. Their dynamic interactions with Bond add depth and intrigue to the storyline, keeping audiences on the edge of their seats until the very end.
        Visually stunning cinematography captures exotic locales and sleek, stylish set pieces, transporting viewers into a world of espionage and intrigue. Each action sequence is masterfully choreographed, delivering jaw-dropping thrills and adrenaline-fueled excitement.
        While License to Thrill pays homage to classic Bond tropes, it also injects fresh energy and modern sensibilities into the franchise, ensuring that it remains relevant for both longtime fans and newcomers alike. With its blend of high-stakes espionage, dazzling spectacle, and charismatic performances, this latest installment is a must-see for action aficionados and Bond enthusiasts alike.
        Overall, License to Thrill: The Return of 007 is a triumphant return to form for the iconic spy franchise, delivering all the thrills, glamour, and excitement that audiences have come to expect from James Bond. Strap in for a white-knuckle ride that will leave you shaken, stirred, and thoroughly entertained.");
        $movie5->setImagePath('https://cdn.pixabay.com/photo/2016/11/16/19/27/daniel-1829795_960_720.jpg');
        $movie5->setPublishDate($movie5PublishDate);
        $slug = $this->slugger->slug($movie5Title)->lower();
        $movie5->setSlug($slug);
        $movie5->setReviwer($this->getReference('reviewerUser1'));
        $movie5->setRating(random_int(5, 10));
        $manager->persist($movie5);

        $movie6 = new Movie();
        $movie6Title = 'Fast and Furious';
        $movie6PublishDate = new DateTime('2024-03-15');
        $movie6->setTitle($movie6Title);
        $movie6->setReleaseYear(random_int(2000, 2024));
        $movie6->setDescription("Fast & Furious: The Original Ride revs up the excitement right from the starting line and never lets off the gas. Vin Diesel commands the screen as the enigmatic and fiercely loyal Dominic Toretto, bringing a perfect balance of charisma and intensity to the role. Paul Walker shines as the undercover cop Brian O'Conner, adding a layer of complexity to the dynamic between law enforcement and the criminal underworld.
        The film's adrenaline-pumping racing sequences are a visual feast for the eyes, with sleek cars, screeching tires, and breathtaking stunts that will leave viewers on the edge of their seats. Director Rob Cohen expertly captures the speed and intensity of street racing, immersing audiences in the heart-pounding action from start to finish.
        But Fast & Furious is more than just fast cars and furious action. At its core, it's a story about family, loyalty, and the bonds that unite us. The chemistry between the characters feels authentic and heartfelt, grounding the film's high-octane thrills with moments of genuine emotion and camaraderie.
        With its pulse-pounding action, charismatic performances, and heartfelt storytelling, Fast & Furious: The Original Ride is a timeless classic that laid the foundation for one of the most successful film franchises of all time. Whether you're a fan of fast cars, thrilling action, or gripping drama, this adrenaline-fueled ride is sure to satisfy your need for speed.
        Overall, Fast & Furious: The Original Ride is a high-octane thrill ride that delivers the perfect blend of adrenaline, heart, and horsepower. Strap in, buckle up, and get ready for the ride of your life.");
        $movie6->setImagePath('https://cdn.pixabay.com/photo/2020/09/06/07/37/car-5548242_1280.jpg');
        $movie6->setPublishDate($movie6PublishDate);
        $slug = $this->slugger->slug($movie6Title)->lower();
        $movie6->setSlug($slug);
        $movie6->setReviwer($this->getReference('reviewerUser1'));
        $movie6->setRating(random_int(5, 10));
        $manager->persist($movie6);

        $movie7 = new Movie();
        $movie7Title = 'Sponge Bob';
        $movie7PublishDate = new DateTime('2024-03-15');
        $movie7->setTitle($movie7Title);
        $movie7->setReleaseYear(random_int(2000, 2024));
        $movie7->setDescription("SpongeBob SquarePants: Bikini Bottom Adventure delivers a tidal wave of laughs and lighthearted fun for audiences of all ages. Director Stephen Hillenburg's imaginative vision brings the beloved cartoon characters to life with vibrant animation and clever humor that will leave viewers grinning from ear to ear.
        At the heart of the film is SpongeBob SquarePants, voiced with infectious enthusiasm by Tom Kenny. SpongeBob's boundless optimism and childlike wonder infuse every frame with joy and energy, making him a lovable protagonist that audiences can't help but root for. Bill Fagerbakke as Patrick Star, Clancy Brown as Mr. Krabs, Rodger Bumpass as Squidward Tentacles, and Carolyn Lawrence as Sandy Cheeks round out the cast with pitch-perfect performances that capture the essence of their iconic characters.
        The film's plot is a rollicking adventure filled with humor, heart, and plenty of underwater hijinks. From jellyfishing escapades to encounters with the villainous Plankton, SpongeBob and his friends embark on a journey that is equal parts absurd and endearing. Along the way, they learn valuable lessons about friendship, teamwork, and the power of staying true to oneself.
        Visually, SpongeBob SquarePants: Bikini Bottom Adventure is a feast for the eyes, with stunning animation that brings the underwater world of Bikini Bottom to dazzling life. From the colorful coral reefs to the bustling streets of the town, every detail is meticulously crafted to create a whimsical and immersive experience that captures the imagination.
        Overall, SpongeBob SquarePants: Bikini Bottom Adventure is a delightful cinematic treat that captures the spirit of the beloved animated series with humor, heart, and a whole lot of silliness. Whether you're a longtime fan of SpongeBob or a newcomer to the world of Bikini Bottom, this charming film is sure to make a splash and leave you smiling long after the credits roll.");
        $movie7->setImagePath('https://cdn.pixabay.com/photo/2012/02/27/17/07/balloon-17555_1280.jpg');
        $movie7->setPublishDate($movie7PublishDate);
        $slug = $this->slugger->slug($movie7Title)->lower();
        $movie7->setSlug($slug);
        $movie7->setReviwer($this->getReference('reviewerUser1'));
        $movie7->setRating(random_int(5, 10));
        $manager->persist($movie7);

        $movie8 = new Movie();
        $movie8Title = 'Hulk';
        $movie8PublishDate = new DateTime('2024-03-15');
        $movie8->setTitle($movie8Title);
        $movie8->setReleaseYear(random_int(2000, 2024));
        $movie8->setDescription("Directed by Ang Lee, Hulk: Unleashed Fury is a visually ambitious and emotionally charged take on the classic Marvel Comics character. The film explores themes of identity, power, and the consequences of unchecked ambition, while delivering plenty of high-octane action sequences and jaw-dropping special effects.
        Eric Bana delivers a solid performance as Bruce Banner, capturing the character's inner turmoil and struggle to come to terms with his newfound abilities. Jennifer Connelly shines as Betty Ross, Banner's love interest and confidante, bringing depth and humanity to her role amidst the chaos unfolding around her. Sam Elliott delivers a commanding performance as General Thaddeus Thunderbolt Ross, adding gravitas to the military antagonist determined to capture the Hulk at any cost.
        While Hulk: Unleashed Fury boasts impressive visuals and thrilling action set pieces, including epic battles between the Hulk and formidable adversaries, the film's pacing can feel uneven at times, with lengthy exposition slowing the momentum of the narrative. Additionally, some viewers may find the film's introspective approach to the character of Bruce Banner and the psychological aspects of his transformation less satisfying than traditional superhero fare.
        Despite these flaws, Hulk: Unleashed Fury offers a unique and thought-provoking take on the iconic green giant, exploring themes of inner conflict and the dual nature of humanity with sincerity and depth. Fans of the Hulk comics and action-packed superhero adventures will find much to enjoy in this ambitious film, which offers a fresh perspective on a beloved character while staying true to his roots.
        Overall, Hulk: Unleashed Fury is a visually stunning and emotionally resonant superhero film that offers a compelling exploration of the human condition amidst the chaos of superhuman conflict. While it may not satisfy all tastes, its bold approach and ambitious storytelling make it a worthy addition to the pantheon of Marvel Comics adaptations.");
        $movie8->setImagePath('https://cdn.pixabay.com/photo/2014/12/23/07/40/hulk-578088_960_720.jpg');
        $movie8->setPublishDate($movie8PublishDate);
        $slug = $this->slugger->slug($movie8Title)->lower();
        $movie8->setSlug($slug);
        $movie8->setReviwer($this->getReference('reviewerUser1'));
        $movie8->setRating(random_int(5, 10));
        $manager->persist($movie8);

        $movie9 = new Movie();
        $movie9Title = 'Jackie Chan';
        $movie9PublishDate = new DateTime('2024-03-15');
        $movie9->setTitle($movie9Title);
        $movie9->setReleaseYear(random_int(2000, 2024));
        $movie9->setDescription("Jackie Chan: Master of Action Comedy is a thrilling and entertaining tribute to the legendary martial artist and actor. Featuring a compilation of some of Chan's most memorable action sequences, comedic moments, and behind-the-scenes footage, the film offers fans an intimate look at the man behind the larger-than-life persona.
        Throughout his illustrious career, Jackie Chan has become synonymous with jaw-dropping stunts, impeccable choreography, and infectious humor, and this documentary highlights his versatility as both a performer and a filmmaker. From his groundbreaking work in classics like Drunken Master and Police Story to his more recent hits like Rush Hour and The Foreigner, Chan's impact on the action genre is undeniable.
        What sets Jackie Chan apart from other action stars is his unique blend of martial arts prowess and physical comedy. Whether he's fighting off hordes of enemies with improvised weapons or engaging in hilarious slapstick antics, Chan's on-screen presence is always magnetic and utterly captivating. His willingness to perform his own stunts, often risking life and limb in the process, has earned him the admiration of fans around the globe.
        In addition to showcasing Chan's incredible action sequences, the documentary also delves into his personal life and the challenges he faced throughout his career. From his humble beginnings in the Hong Kong film industry to his crossover success in Hollywood, Chan's journey is a testament to hard work, determination, and unwavering passion for his craft.
        Jackie Chan: Master of Action Comedy is a must-watch for fans of martial arts cinema and anyone who appreciates the art of filmmaking. It pays homage to a true cinematic icon and serves as a reminder of Jackie Chan's enduring legacy as one of the greatest action stars of all time.");
        $movie9->setImagePath('https://cdn.pixabay.com/photo/2017/08/28/10/47/jackie-chan-2689112_1280.jpg');
        $movie9->setPublishDate($movie9PublishDate);
        $slug = $this->slugger->slug($movie9Title)->lower();
        $movie9->setSlug($slug);
        $movie9->setReviwer($this->getReference('reviewerUser1'));
        $movie9->setRating(random_int(5, 10));
        $manager->persist($movie9);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }
}
