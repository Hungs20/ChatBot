
﻿Hướng dẫn cài đặt UET Chatbot
Link youtube: https://youtu.be/oqiJQQjfOas

+ Công cụ cần thiết
	- Hosting Php + Mysql ( https://heroku.com ) (Các bạn đăng kí tài khoản trên heroku nhé)
	- Source Code ( https://github.com/Hungs20/ChatBot/ )
	- Fanpage ( https://www.facebook.com/cvhungs20/ )
	- Chatfuel ( chatfuel.com ) (Các bạn đăng kí tài khoản chatfuel nhé)
	- Github + git (Các bạn đăng kí tài khoản trên github nhé)
+ Cài đặt code + data
	- Fork code tại github
	- Đăng kí tài khoản heroku 
	- Tạo database
	- Edit Config Vars
	- Install database
+ Cài đặt Chatfuel
	
	Các bạn thay link https://uetbot.herokuapp.com thành link của các bạn nhé
	
	- Welcome message
		https://uetbot.herokuapp.com/update.php
	- Default answer
		https://uetbot.herokuapp.com/update.php
	- Tạo các block
		* thamgia
			https://uetbot.herokuapp.com/update.php
			https://uetbot.herokuapp.com/thamgia.php
		* uetchat
			{{uet_text}}
		* uet_image
			http://uetbot.herokuapp.com/getimage.php
		* uet_void
			http://uetbot.herokuapp.com/getvoid.php
		* uet_video
			http://uetbot.herokuapp.com/getvideo.php
		* uet_file
			http://uetbot.herokuapp.com/getfile.php
		* send_chat
			https://uetbot.herokuapp.com/send_chat.php
		* thoat
			https://uetbot.herokuapp.com/thoat.php
		* xacnhan
		* block
			https://uetbot.herokuapp.com/block.php
		* xacnhanblock
		* huongdan
		* getinfo 
			https://uetbot.herokuapp.com/info.php
			
	- Chỉnh config heroku tiếp nào
	- Tiếp theo sử dụng api để check ảnh nhạy cảm tránh bị block nhắn tin của facebook
		https://dashboard.sightengine.com/
		CÁc bạn đăng kí tài khoản trên này nhé
		Giờ connect chatfuel với fanpage của bạn và test thôi
		
		Vậy là đã xong chatbot kết nối với người lạ khác giới tính rồi đó
		Xin chào các bạn...
