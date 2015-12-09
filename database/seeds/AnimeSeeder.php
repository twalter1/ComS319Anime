<?php

use App\Anime;
use Illuminate\Database\Seeder;

class AnimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('animes')->delete();

        $animes = new Anime;
        $animes->name = 'Sword Art Online';
        //This picture was taken from https://totesenota.files.wordpress.com/2015/03/sword-art-online-cover.jpg
        $animes->profile_url = 'images/sword-art-online-cover.jpg';
        $animes->genre = '[{"name":"action"}, {"name":"drama"}, {"name":"adventure"}]';
        $animes->status = 'completed';
        $animes->numSeasons = '1';
        $animes->numEpisodes = '25';
        //This description was take from http://www.ryuanime.com/watch-anime/sword-art-online/
        $animes->description = 'In the near future, a Virtual Reality Massive Multiplayer Online Role-Playing Game (VRMMORPG) called Sword Art Online has been released where players control their avatars with their bodies using a piece of technology called Nerve Gear. One day, players discover they cannot log out, as the game creator is holding them captive unless they reach the 100th floor of the games tower and defeat the final boss. However, if they die in the game, they die in real life. Their struggle for survival starts now...';
        $animes->save();

        $animes = new Anime;
        $animes->name = 'Sword Art Online II';
        //This picture was taken from http://www.ryuanime.tv/watch-anime/sword-art-online-ii
        $animes->profile_url = 'images/1142.jpg';
        $animes->genre = '[{"name":"drama"}, {"name":"action"}, {"name":"romance"}]';
        $animes->status = 'completed';
        $animes->numSeasons = '1';
        $animes->numEpisodes = '24';
        //This description was taken from http://www.ryuanime.com/watch-anime/sword-art-online-ii/
        $animes->description = '1 year after the SAO incident, Kirito is approached by Seijiro Kikuoka from Japans Ministry of Internal Affairs and Communications Department "VR Division" with a rather peculiar request. That was an investigation on the "Death Gun" incident that occurred in the gun and steel filled VRMMO called Gun Gale Online (GGO). "Players who are shot by a mysterious avatar with a jet black gun lose their lives even in the real world..." Failing to turn down Kikuokas bizarre request, Kirito logs in to GGO even though he is not completely convinced that the virtual world could physically affect the real world. Kirito wanders in an unfamiliar world in order to gain any clues about the "Death Gun." Then, a female sniper named Sinon who owns a gigantic "Hecate II" rifle extends Kirito a helping hand. With Sinons help, Kirito decides to enter the "Bullet of Bullets," a large tournament to choose the most powerful gunner within the realm of GGO, in hopes to become the target of the "Death Gun" and make direct contact with the mysterious avatar.';
        $animes->save();

        $animes = new Anime;
        $animes->name = 'One Piece';
        //This picture was taken from http://www.ryuanime.tv/watch-anime/one-piece
        $animes->profile_url = 'images/565.jpg';
        $animes->genre = '[{"name":"adventure"}, {"name":"comedy"}, {"name":"fantasy"}, {"name":"fighting"}]';
        $animes->status = 'ongoing';
        $animes->numSeasons = '7';
        $animes->numEpisodes = '716';
        //This description was taken from http://www.ryuanime.com/watch-anime/one-piece/
        $animes->description = 'Before he was executed, the legendary Pirate King Gold Roger revealed that he had hidden the treasure One Piece somewhere in the Grand Line. Now, many pirates are off looking for this legendary treasure to claim the title Pirate King. One pirate, Monkey D. Luffy, is a boy who had eaten the Devils Fruit and gained rubber powers. Now he and his crew are off to find One Piece, while battling enemies and making new friends along the way.';
        $animes->save();

        $animes = new Anime;
        $animes->name = 'Full Metal Alchemist: Brotherhood';
        //This image was taken from http://www.ryuanime.tv/watch-anime/fullmetal-alchemist-brotherhood
        $animes->profile_url = 'images/554.jpg';
        $animes->genre = '[{"name":"adventure"}, {"name":"comedy"}, {"name":"drama"}]';
        $animes->status = 'completed';
        $animes->numSeasons = '1';
        $animes->numEpisodes = '64';
        //This description was taken from http://www.ryuanime.com/anime-series/fullmetal-alchemist-brotherhood/
        $animes->description = 'Two brothers lose their mother to an incurable disease. With the power of "alchemy", they use taboo knowledge to resurrect her. The process fails, and as a toll for using this type of alchemy, the older brother, Edward Elric loses his left leg while the younger brother, Alphonse Elric loses his entire body. To save his brother, Edward sacrifices his right arm and is able to affix his brothers soul to a suit of armor. With the help of a family friend, Edward receives metal limbs - "automail" - to replace his lost ones. With that, Edward vows to search for the Philosophers Stone to return the brothers to their original bodies, even if it means becoming a "State Alchemist", one who uses his/her alchemy for the military.';
        $animes->save();

        $animes = new Anime;
        $animes->name = 'Gurren Lagaan';
        //This image was taken from http://www.ryuanime.tv/watch-anime/gurren-lagann
        $animes->profile_url = 'images/138.jpg';
        $animes->genre = '[{"name":"action"}, {"name":"comedy"}, {"name":"mecha"}, {"name":"sci-fy"}]';
        $animes->status = 'completed';
        $animes->numSeasons = '2';
        $animes->numEpisodes = '37';
        //This description was taken from http://www.ryuanime.com/anime-series/gurren-lagann/
        $animes->description = 'In a far away future, mankind lives underground in huge caves, unknowing of a world above with a sky and stars. In the small village of Jiha, Simon, a shy boy who works as a digger discovers a strange glowing object during excavation. The enterprising Kamina, a young man with a pair of rakish sunglasses and the passion of a firey sun, befriends Simon and forms a small band of brothers, the Gurren Brigade, to escape the village and break through the ceiling of the cave to reach the surface, which few believe exist. The village elder wont hear of such foolishness and punishes the Brigade. However, when disaster strikes from the world above and the entire village is in jeopardy, its up to Simon, Kamina, a girl with a big gun named Yoko, and the small yet sturdy robot, Lagann, to save the day. The new friends journey to the world above and find that the surface is a harsh battlefield, and its up to them to fight back against the rampaging Beastmen to turn the tide in the humans favor! Pierce the heavens, Gurren Lagann!';
        $animes->save();

        $animes = new Anime;
        $animes->name = 'Bleach';
        //This image was taken from http://www.ryuanime.tv/watch-anime/bleach
        $animes->profile_url = 'images/566.jpg';
        $animes->genre = '[{"name":"action"}, {"name":"drama"}, {"name":"supernatural"}]';
        $animes->status = 'completed';
        $animes->numSeasons = '5';
        $animes->numEpisodes = '364';
        //This description was taken from http://www.ryuanime.com/anime-series/bleach/
        $animes->description = 'Ichigo Kurosaki is a 15-year-old-boy who has an ability to see ghosts/spirits. Because of his ability, he is able to meet a female death god (AKA Shinigami) named Rukia Kuchiki. To save his family and friends from unwanted soul-eating spirits (Hollows), Rukia transfers her Shinigami powers to Ichigo. As Rukia takes on a human shell, together they solve mysteries involving spirits and Hollows until from the spirit world come two other Shinigami, who explain that it is illegal to transfer Shinigami powers to humans and that Rukia exceeded the time limit to stay in the human world. After they sentence her death for breaking the law, Ichigo snaps and swears to everyone he will retrieve Rukia by breaking into the spirit world.';
        $animes->save();

        $animes = new Anime;
        $animes->name = 'Naruto';
        //This image was take from http://www.ryuanime.tv/watch-anime/naruto
        $animes->profile_url = 'images/1418.jpg';
        $animes->genre = '[{"name":"action"}, {"name":"drama"}, {"name":"comedy"}, {"name":"ninja"}]';
        $animes->status = 'completed';
        $animes->numSeasons = '4';
        $animes->numEpisodes = '220';
        //This description was taken from http://www.ryuanime.com/anime-series/naruto/
        $animes->description = 'Naruto closely follows the life of a boy who is feared and detested by the villagers of the hidden leaf village of Konoha. The distrust of the boy has little to do with the boy himself, but it�s what�s inside him that causes anxiety. Long before Naruto came to be, a Kyuubi (demon fox) with great fury and power waged war taking many lives. The battle ensued for a long time until a man known as the Fourth Hokage, Yondaime, the strongest ninja in Konoha, fiercely fought the Kyuubi. The fight was soon won by Yondaime as he sealed the evil demon in a human body. Thus the boy, Naruto, was born. As Naruto grows he decides to become the strongest ninja in Konoha in an effort to show everyone that he is not as they perceive him to be, but is a human being worthy of love and admiration. But the road to becoming Hokage, the title for the strongest ninja in Konoha, is a long and arduous one. It is a path filled with betrayal, pain, and loss; but with hard work, Naruto may achieve Hokage.';
        $animes->save();

        $animes = new Anime;
        $animes->name = 'When Supernatual Battles Became Commonplace';
        //This image was taken from http://www.crunchyroll.com/forumtopic-851717/when-supernatural-battles-became-commonplace-anticipation-and-discussion
        $animes->profile_url = 'images/superNaturalBattles.jpg';
        $animes->genre = '[{"name":"action"}, {"name":"fantasy"}, {"name":"comedy"}, {"name":"romance"}]';
        $animes->status = 'completed';
        $animes->numSeasons = '1';
        $animes->numEpisodes = '12';
        //This description was taken from https://en.wikipedia.org/wiki/When_Supernatural_Battles_Became_Commonplace#Anime
        $animes->description = 'The story focuses on Senkō High Schools Literature Club, whose five members; Jurai, Tomoyo, Hatoko, Sayumi, and Chifuyu, have all somehow developed superpowers. The superpowers have now become a part of their everyday lives as they battle against others wielding similar powers.';
        $animes->save();

        $animes = new Anime;
        $animes->name = 'Steins; Gate';
        //This image was taken from http://www.ryuanime.tv/watch-anime/steins-gate
        $animes->profile_url = 'images/671.jpg';
        $animes->genre = '[{"name":"action"}, {"name":"thriller"}]';
        $animes->status = 'completed';
        $animes->numSeasons = '1';
        $animes->numEpisodes = '25';
        //This description was taken from http://www.ryuanime.com/anime-series/steins-gate/
        $animes->description = 'The eccentric mad scientist Okabe, his childhood friend Mayuri, and the otaku hacker Daru have banded together to form the "Future Gadget Research Laboratory", and spend their days in a ramshackle laboratory hanging out and occasionally attempting to invent incredible futuristic gadgets. However, their claymore is a hydrator and their hair dryer flips breakers, and the only invention that�s even remotely interesting is their Phone Microwave, which transforms bananas into oozing green gel. But when an experiment goes awry, the gang discovers that the Phone Microwave can also send text messages to the past. And whats more, the words they send can affect the flow of time and have unforeseen, far-reaching consequences - consequences that Okabe may not be able to handle...';
        $animes->save();

        $animes = new Anime;
        $animes->name = 'Cromartie High School';
        //This image was taken from http://www.ryuanime.tv/watch-anime/cromartie-high-school
        $animes->profile_url = 'images/449.jpg';
        $animes->genre = '[{"name":"comedy"}]';
        $animes->status = 'completed';
        $animes->numSeasons = '1';
        $animes->numEpisodes = '26';
        //This description was taken from http://www.ryuanime.com/anime-series/cromartie-high-school/
        $animes->description = 'Folks, meet Takashi Kamiyama. Enrolled at Cromartie High, where everybody is a delinquent, Kamiyama is apparently the only non-delinquent in the school. Logically, therefore, he must be the toughest in his class - by the rather twisted logic that only a really tough rabbit would lie down with lions. Thus begins a story that parodies every clich� of tough-guy anime that youve ever heard of, and some you havent. Oh, and Freddie Mercury is in it, too.';
        $animes->save();

        $animes = new Anime;
        $animes->name = 'Kill la Kill';
        //This image was taken from http://www.ryuanime.tv/watch-anime/kill-la-kill
        $animes->profile_url = 'images/140.jpg';
        $animes->genre = '[{"name":"comedy"}, {"name":"action"}]';
        $animes->status = 'completed';
        $animes->numSeasons = '1';
        $animes->numEpisodes = '25';
        //This description was taken from http://www.ryuanime.com/anime-series/kill-la-kill/
        $animes->description = 'Ryuuko Matoi is a vagrant school girl traveling from place to place searching for clues to the truth behind her father\'s death�the "woman with the scissor blade." The journey has led Ryuuko to Honnouji Academy. Honnouji Academy�where an elite group of students is granted superhuman power by their special uniforms called the "Goku uniform." With the power of the uniform, the student body president, Satsuki Kiryuin rules the students with unquestioned power and fear. Satsuki holds the secret to the "scissor blade" and Ryuuko confronts Satsuki to gain information but... Was their encounter a mere coincidence or fate? The clash between the two will soon consume the whole academy!';
        $animes->save();

        $animes = new Anime;
        $animes->name = 'Baccano!';
        //This image was taken from http://www.ryuanime.tv/watch-anime/baccano
        $animes->profile_url = 'images/113.jpg';
        $animes->genre = '[{"name":"horror"}, {"name":"action"}, {"name":"comedy"}]';
        $animes->status = 'completed';
        $animes->numSeasons = '1';
        $animes->numEpisodes = '16';
        //This description was taken from http://www.ryuanime.com/anime-series/baccano/
        $animes->description = 'During the late 1930s in Chicago, the transcontinental train, Flying Pussyfoot, is starting its legendary journey that will leave a trail of blood all over the country. At the same time in New York, the ambitious scientist Szilard and his unwilling aide Ennis, are looking for missing bottles of the immortality elixir. In addition, a war between the mafia groups is getting worse. On board the Advena Avis, in 1711, alchemists are about to learn the price of immortality. Based on the award winning light novels of the same name, this anime adaptation follows several events that initially seem unrelated, both in time and place, but are part of a much bigger story � one of alchemy, survival and immortality. Merging these events together are the kindhearted would-be thieves, Isaac and Miria, connecting various people, all of them with their own hidden ambitions and agendas, and creating lifelong bonds and consequences for everyone involved.';
        $animes->save();

    }
}
