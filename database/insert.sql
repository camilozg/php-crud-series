INSERT INTO `platform`(`name`) 
VALUES ('Netflix')
,('Amazon Prime')
,("HBO MAX")
,("Apple TV")
,('Disney +');

INSERT INTO `languaje`(`name`, `iso_code`) 
VALUES ('italiano','it')
,('inglés','en')
,('español','es')
,('francés','fr');

INSERT INTO `actor`(`name`, `lastname`, `birth_date`, `nationality`) 
VALUES ('Millie','Brown','2004-02-19','Estados Unidos')
,('Finn','Wolfhard','2002-12-23','Estados Unidos')
,('Gaten','Matarazzo','2002-11-08','Estados Unidos')
,('Travis','Fimmel','1979-06-15','Estados Unidos')
,('Katheryn','Winnick','1977-12-17','Estados Unidos')
,('Alexander','Ludwig','1992-05-07','Estados Unidos')
,('Álvaro','Morte','1975-02-23','España')
,('Úrsula','Corberó','1989-08-11','España')
,('Pedro','Alonso','1971-06-21','España');

INSERT INTO `director`(`name`, `lastname`, `birth_date`, `nationality`) 
VALUES ('Shawn','Levy','1968-07-23','Estados Unidos')
,('Morgan','Sullivan','1945-05-04','Estados Unidos')
,('Álex','Pina','1967-06-23','España');

INSERT INTO `serie`(`title`, `synopsis`) 
VALUES ('Stranger Things','Cuando un niño desaparece, sus amigos, la familia y la policía se ven envueltos en una serie de eventos misteriosos al tratar de encontrarlo. Su ausencia coincide con el avistamiento de una criatura terrorífica y la aparición de una extraña niña.')
,('Vikings','El vikingo Ragnar Lothbrok es un joven agricultor y hombre de familia que se siente frustrado por las políticas de Earl Haraldson, el conde del lugar que envía a sus invasores vikingos al este de los países bálticos y Rusia, cuyos residentes son pobres como los escandinavos.')
,('La casa de papel','Una banda organizada de ladrones se propone cometer el atraco del siglo en la Fábrica Nacional de Moneda y Timbre. Cinco meses de preparación quedarán reducidos a once días para poder llevar a cabo con éxito el gran golpe.');

INSERT INTO `serie_actor`(`serie_id`, `actor_id`) VALUES (1,1),(1,2),(1,3),(2,4),(2,5),(2,6),(3,7),(3,8),(3,9);

INSERT INTO `serie_audio_lang`(`serie_id`, `languaje_id`) VALUES (1,1),(1,2),(1,3),(1,4),(2,1),(2,2),(2,4),(3,1),(3,3),(3,4);

INSERT INTO `serie_caption_lang`(`serie_id`, `languaje_id`) VALUES (1,1),(1,2),(1,3),(1,4),(2,1),(2,2),(2,4),(3,1),(3,3),(3,4);

INSERT INTO `serie_director`(`serie_id`, `director_id`) VALUES (1,1),(2,2),(3,3);

INSERT INTO `serie_platform`(`serie_id`, `platform_id`) VALUES (1,1),(1,2),(1,4),(2,2),(2,3),(2,5),(3,1),(3,3),(3,5);