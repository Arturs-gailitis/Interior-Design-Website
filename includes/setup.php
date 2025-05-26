<?php
require_once "db.php";

try {
    $con = new PDO("mysql:host=$host;port=$port;dbname=$database", $username, $password);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create tables
    $designproject = "CREATE TABLE IF NOT EXISTS projects (
        id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL UNIQUE,
        description TEXT NOT NULL,
        location VARCHAR(150) NOT NULL,
        start_day DATE NOT NULL,
        end_day DATE,
        status VARCHAR(50) NOT NULL,
        image_path VARCHAR(255) NOT NULL
    )";

    $user = "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL UNIQUE,
        email VARCHAR(100) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL
    )";

    $messages = "CREATE TABLE IF NOT EXISTS messages (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255),
        email VARCHAR(255),
        message TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        Status VARCHAR(255)
    )";

    $con->exec($designproject);
    $con->exec($user);
    $con->exec($messages);

    // Clear projects for fresh insert
    $con->exec("DELETE FROM projects");

    // Insert demo projects 
     $projects = [
        [
            'title' => 'From Dated & Dark to Bright Modern Living Space',
            'description' => "Client Goal: Transform a dark, outdated living area with closed-off spaces into an open, bright, and modern layout. The client wanted a functional open-concept space with a contemporary kitchen island and a cozy yet sleek living area.\n\n● Removed the old carpet and dated tile, replacing them with light wood flooring throughout.\n● Eliminated the dark wood paneling to visually open up the space and allow natural light to flow freely.\n● Installed a modern kitchen island with pendant lighting and stylish bar stools for both form and function.\n● Added a vertical slat partition at the staircase—an architectural feature that adds design interest and defines the space.\n● Furnished the living area with a compact, modern sofa, soft textiles, and a patterned rug to create a warm and inviting ambiance.\n\nResult: A bright, elegant, and highly functional living space with a cohesive modern look. The client was thrilled with the transformation and how the space now breathes with light and purpose.",
            'location' => 'Valmiera',
            'start_day' => '2024-02-01',
            'end_day' => '2024-03-02',
            'status' => 'completed',
            'image_path' => 'uploads/1748203517_design_1.jpg'
        ],
        [
            'title' => 'Full Open-Concept Living Room + Kitchen Transformation',
            'description' => "Client Goal: The client wanted to eliminate the outdated and compartmentalized layout of their home. Their vision was a seamless, open-concept space that would connect the living room and kitchen.\n\n● Removed dividing walls to open up the floor plan\n● Replaced carpet and mixed flooring with continuous light-toned hardwood\n● Installed a full custom kitchen with white cabinetry, marble backsplash, and a central island\n● Added modern pendant lighting to define the kitchen space\n● Refreshed the fireplace with new paint and accessorized it with cozy, symmetrical seating\n\nResult: The final design delivered a bright, elegant, and unified living and kitchen area. The space now feels significantly larger, more welcoming, and perfect for both everyday living and entertaining.",
            'location' => 'Riga',
            'start_day' => '2024-03-15',
            'end_day' => '2024-04-16',
            'status' => 'completed',
            'image_path' => 'uploads/1748204368_design_2.jpg'
        ],
        [
            'title' => 'Minimalist Room to Inspiring Home Office',
            'description' => "Client Goal: The client needed to turn a plain, unused room into a functional home office with style and personality. Their priorities were a comfortable work area, built-in storage, and a design that inspires creativity and focus.\n\n● Added a bold green accent wall to bring depth and contrast\n● Installed custom built-in cabinetry and floating shelves for organized storage\n● Designed a wood-slat ceiling detail to visually zone the workspace and add a touch of architectural flair\n● Introduced a natural wood desk and layered lighting to support productivity\n● Completed the space with cozy seating, indoor plants, and soft textiles for warmth and livability\n\nResult: A stunning transformation from a blank canvas to a vibrant, functional office that balances practicality with design-forward aesthetics. The client now has a space that motivates them daily and feels uniquely theirs.",
            'location' => 'Ventspils',
            'start_day' => '2024-04-21',
            'end_day' => '2024-05-25',
            'status' => 'completed',
            'image_path' => 'uploads/1748204636_design_4.jpg'
        ],
        [
            'title' => 'From Empty Shell to Sophisticated Urban Lounge',
            'description' => "Client Goal: The client had just moved into this modern apartment and wanted to furnish the open living room with a high-end, cozy atmosphere that still allowed the expansive windows and natural light to take center stage. They asked for warmth, functionality, and a visually polished layout.\n\n● Anchored the room with a plush L-shaped sectional to provide ample seating\n● Added accent chairs with bold patterns to introduce visual texture and personality\n● Positioned a sleek coffee table and layered a soft area rug for added warmth\n● Mounted a large-screen TV above the fireplace to blend entertainment and design\n● Included greenery and statement decor pieces to breathe life into the space\n\nResult: The once-empty room was transformed into a welcoming, luxurious urban lounge perfect for relaxing or entertaining. With strategic furnishing and bold accessories, the design now complements the architectural features without overpowering them.",
            'location' => 'Cēsis',
            'start_day' => '2024-04-27',
            'end_day' => '2024-05-18',
            'status' => 'completed',
            'image_path' => 'uploads/1748204871_design_5.jpg'
        ],
        [
            'title' => 'From Construction Site to Fully Visualized Living Space',
            'description' => "Client Goal: The client requested a 3D interior design concept for a newly built home still under construction. They wanted to visualize how the open-plan area could function as a vibrant, welcoming space for living, dining, and entertaining—before making any final furnishing decisions.\n\n● Developed a virtual interior layout with clearly defined living, kitchen, and dining zones\n● Highlighted the existing architectural beams with dark accents to add contrast and rhythm\n● Designed a functional kitchen with a bar counter, modern stools, and open shelving\n● Introduced a warm and playful color palette with coral, soft gray, and black elements\n● Completed the design with lighting, soft textiles, and greenery to create a cozy, contemporary feel\n\nResult: The client was thrilled with the ability to preview their future space in detail. The virtual staging provided clarity and inspiration, helping them make confident choices and visualize how their new home would feel once finished and fully furnished.",
            'location' => 'Rīga',
            'start_day' => '2025-01-15',
            'end_day' => '2025-02-02',
            'status' => 'completed',
            'image_path' => 'uploads/1748205093_design_6.jpg'
        ],
        [
            'title' => 'From Empty Room to Elegant Modern Living Area',
            'description' => "Client Goal: The client wanted to turn a completely empty room into a functional and visually pleasing living space. Their priority was to keep the look minimal and bright, while still introducing warmth and personality.\n\n● Positioned a white sectional sofa to provide generous seating without overwhelming the space\n● Introduced a light area rug to soften the contrast with the dark wood flooring\n● Added a sleek, floating TV unit and wall-mounted television to preserve floor space and maintain clean lines\n● Incorporated pops of pattern and color through throw pillows and a framed art piece\n● Completed the space with a large indoor plant and sculptural coffee table for natural balance and texture\n\nResult: The room was transformed into a polished and inviting living area. It now feels open and stylish, with a calming palette and just enough detail to reflect a modern, livable personality. The client was especially pleased with how the space maintained simplicity without feeling empty.",
            'location' => 'Alūksne',
            'start_day' => '2025-03-12',
            'end_day' => '2025-04-01',
            'status' => 'completed',
            'image_path' => 'uploads/1748205271_design_8.jpg'
        ],
        [
            'title' => 'Industrial Shell to Stylish Urban Loft',
            'description' => "Client Goal: The client had acquired a raw, unfinished industrial space with high ceilings and concrete walls. Their vision was to convert it into a livable, open-plan loft that retained the building’s industrial character while offering warmth, comfort, and functionality for daily living.\n\n● Designed and constructed a mezzanine level to add usable space for sleeping or lounging\n● Installed a floating staircase with metal railings for a modern, minimalistic aesthetic\n● Created an open kitchen and dining area using matte black finishes and natural wood elements\n● Chose a leather sofa, layered rugs, and mixed metal lighting fixtures to balance comfort with industrial edge\n● Added bold wall art, subtle decor, and storage that suits the loft’s high ceilings and open layout\n\nResult: The abandoned, concrete box was transformed into a vibrant, stylish home full of personality. The loft now blends industrial roots with modern-day luxury, creating a functional yet visually captivating living space. The client was amazed by the dramatic shift and the cozy feel of the final design.",
            'location' => 'Valmiera',
            'start_day' => '2025-04-12',
            'end_day' => '2025-06-25',
            'status' => 'planned',
            'image_path' => 'uploads/1748205442_design_7.jpg'
        ],
        [
            'title' => 'From Blank High-Rise to Sophisticated City Lounge',
            'description' => "Client Goal: The client had just moved into a brand-new high-rise apartment and wanted to transform the empty living space into a stylish, comfortable lounge. Their aim was to keep the design sleek and neutral while introducing enough character to feel warm and personal.\n\n● Positioned a modern gray sectional and accent chairs to frame the city view without blocking light\n● Layered in a large, textured area rug to soften the space and add visual depth\n● Mounted contemporary artwork and a gallery wall to personalize and ground the room\n● Used low-profile furniture and clean lines to emphasize the open, airy architecture\n● Introduced soft lighting, a floor lamp, and natural wood accents to warm up the minimalist setting\n\nResult: This once-empty apartment corner now feels like a curated city retreat—elegant yet inviting. The client loved how the furniture layout and decor highlighted the room’s modern angles while keeping the atmosphere relaxed and livable.",
            'location' => 'Jūrmala',
            'start_day' => '2025-05-01',
            'end_day' => '2025-07-26',
            'status' => 'on hold',
            'image_path' => 'uploads/1748205707_design_9.jpg'
        ]
    ];

       $stmt = $con->prepare("INSERT INTO projects (title, description, location, start_day, end_day, status, image_path) VALUES (:title, :description, :location, :start_day, :end_day, :status, :image_path)");

    foreach ($projects as $p) {
        $stmt->execute($p);
    }

    echo "<h2>Setup Complete!</h2>";
    echo "<p>Database and demo projects added successfully.</p>";
    echo "<p>You can now <a href='../index.php'>access the website</a>.</p>";

} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}