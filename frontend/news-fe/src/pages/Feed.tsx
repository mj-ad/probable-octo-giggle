import { useEffect, useState } from "react";
import axios from "axios";

interface Post {
  id: number;
  title: string;
  body: string;
  // add other fields as needed
}

export default function Feed() {
  const [posts, setPosts] = useState<Post[]>([]);
  const [error, setError] = useState<string | null>(null);

  useEffect(() => {
    const fetchPosts = async () => {
      try {
        const token = localStorage.getItem("token");
        if (!token) {
          setError("User not authenticated");
          return;
        }

        const response = await axios.get("http://localhost:8000/api/feed", {
          headers: {
            Authorization: `Bearer ${token}`,
          },
        });
        setPosts(response.data);
      } catch (err: any) {
        setError(err.response?.data?.message || "Failed to fetch posts");
      }
    };

    fetchPosts();
  }, []);

  return (
    <div>
      <h1>Feed</h1>
      {error && <p style={{ color: "red" }}>{error}</p>}
      {posts.length === 0 && !error && <p>No posts found.</p>}
      {posts.map((post) => (
        <div key={post.id}>
          <h3>{post.title}</h3>
          <p>{post.body}</p>
        </div>
      ))}
    </div>
  );
}
