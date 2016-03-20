import re
import argparse


def run(file_path):
    with open(file_path, 'r') as f:
	pattern_all = 'Duration: (\d{2}):(\d{2}):(\d{2}).(\d{2}),'
	info = f.read()
	all_results = re.findall(pattern_all, info)[-1]
	
	all_time = long(all_results[0]) * 3600 +long(all_results[1]) * 60 + long(all_results[2]) + long(all_results[2]) / 100.0
	pattern_now = 'time=(\d{2}):(\d{2}):(\d{2}).(\d{2})'
	now_results = re.findall(pattern_now, info)[-1]
	now_time = long(now_results[0]) * 3600 +long(now_results[1]) * 60 + long(now_results[2]) + long(now_results[2]) / 100.0
	
	return float(100 * now_time / all_time)
if __name__ == '__main__':
    parser = argparse.ArgumentParser()
    parser.add_argument('file_path', help='the log file path')
    args = parser.parse_args()
    file_path = args.file_path
    print run(file_path)
