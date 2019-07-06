select user.u_cover,udata.u_name,udata.id,content,at_type,picture,video,udata.create_at from user,udata where udata.u_name=user.u_name and at_type='视频' order by udata.create_at desc;
select user.u_cover,udata.u_name,udata.id,content,at_type,picture,video,udata.create_at from user,udata where udata.u_name=user.u_name and user.u_name='user1' order by udata.create_at desc;

select picture from udata where u_name='user1';

